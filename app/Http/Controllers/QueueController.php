<?php

namespace App\Http\Controllers;

use App\Models\ProgramEvent;
use App\Models\QueueElement;
use App\Repositories\ConfigRepository;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    /**
     * @var ConfigRepository
     */
    protected $configRepository;

    public function __construct(ConfigRepository $configRepository) {
        $this->configRepository = $configRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        return view(
            'queue.index', [
                             'queues'               => QueueElement::all()->sortBy("display_at"),
                             "queue_interval"       => $this->configRepository->get("queue.interval"),
                             "queue_interval_min"   => $this->configRepository->get("queue.interval_min"),
                         ]
        );
    }

    public function toggle($id) {
        /** @var QueueElement $qe */
        $qe = QueueElement::find($id);

        $qe->was_displayed = !$qe->was_displayed;
        $qe->save();

        return redirect()->route('queue-entries')
            ->with('success', "Toggled to {$qe->was_displayed}");
    }

    public function rebuild() {
        \App\Jobs\RegenerateQueue::dispatchSync();

        return redirect()->route('queue-entries')
            ->with('success', "Queue rebuilt");
    }
}
