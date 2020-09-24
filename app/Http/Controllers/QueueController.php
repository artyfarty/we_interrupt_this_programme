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

    public function toggle($id, $set = "toggle") {
        /** @var QueueElement $qe */
        $qe = QueueElement::find($id);

        if ($set === "toggle") {
            $qe->was_displayed = !$qe->was_displayed;
        } else {
            $qe->was_displayed = !!$set;
        }

        $qe->save();

        $msg = $qe->was_displayed ? "q#$id Помечено показанным" : "q#$id Помечено не показанным";

        return redirect()->route('queue-entries')
            ->with('success', $msg);
    }

    public function rebuild() {
        \App\Jobs\RegenerateQueue::dispatchSync();

        return redirect()->route('queue-entries')
            ->with('success', "Queue rebuilt");
    }
}
