<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Models\QueueElement;
use App\Repositories\ConfigRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Mockery\Matcher\Not;

class RegenerateQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var ConfigRepository
     */
    protected $configRepository;

    public function __construct(ConfigRepository $configRepository) {
        $this->configRepository = $configRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message_interval = +$this->configRepository->get("queue.interval");
        $planning_horizon = date_create($this->configRepository->get("queue.horizon"));
        //$planning_starting_point = date_create();

        $timeslots = [];


        $notifications = Notification::all();

        /*
         * спасаем то что уже показано
        DB::table("queue_elements")
            ->where("was_displayed")
        */

        // исходим из того что все уведомления должны попасть в очередь ХОТЯ БЫ раз
        // сначала проходимся по уведомляшкам и планируем их. затем проходимся по получившемуся расписанию и выправляем его, устраняя противоречия согласно приоритетам

        foreach ($notifications as $notification) {
            if ($this->shoudBeQueued($notification)) {
                $this->queue($notification);
            }
        }
    }

    /**
     * @param Notification $n
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected function getQueued(Notification $n) {
        return $n->queued();
    }

    protected function shoudBeQueued(Notification $n) {
        return $this->getQueued($n)->count() < 1;
    }

    protected function mayBeQueued(Notification $n) {
        return $this->getQueued($n)->count() < $n->display_limit;
    }

    protected function queue(Notification  $n) {


        $q = new QueueElement([]);
    }
}
