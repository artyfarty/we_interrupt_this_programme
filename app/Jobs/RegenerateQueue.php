<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Models\QueueElement;
use App\Repositories\ConfigRepository;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Matcher\Not;

class RegenerateQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var ConfigRepository
     */
    protected $configRepository;

    protected $minInterval = 0;
    protected $normalInterval = 0;

    public function __construct() {

        $this->configRepository = resolve(ConfigRepository::class);

        $this->minInterval = +$this->configRepository->get("queue.interval_min");
        $this->normalInterval = +$this->configRepository->get("queue.interval");
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug("Begin regeneration");

        //$notifications = DB::table("notifications")->orderBy("priority, display_from")->get();
        $notifications = Notification::all()->sortBy("priority, display_from");

        QueueElement::whereWasDisplayed(0)->delete();

        // исходим из того что все уведомления должны попасть в очередь ХОТЯ БЫ раз
        // сначала проходимся по уведомляшкам и планируем их. затем проходимся по получившемуся расписанию и выправляем его, устраняя противоречия согласно приоритетам

        foreach ($notifications as $notification) {
            if ($this->shoudBeQueued($notification)) {
                $this->queueNotification($notification, true);
            }
        }

        Log::debug("Adding additional messages (fillers)");

        $skip_notifications = [];
        $notifications_to_still_process = $notifications->whereNotIn("id", $skip_notifications);

        do {
            foreach ($notifications_to_still_process as $notification) {
                $should_retry = false;

                if ($this->mayBeQueued($notification)) {
                    $should_retry = $this->queueNotification($notification, false);
                }

                if (!$should_retry) {
                    $skip_notifications[] = $notification->id;
                }
            }

            $notifications_to_still_process = $notifications_to_still_process->whereNotIn("id", $skip_notifications);
        } while ($notifications_to_still_process->count() > 0);


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

    protected function isTimeslotSafe(DateTime $display_at, $interval) {
        $interval -= 1;

        $display_at_min = (clone $display_at)->modify("-{$interval}seconds");
        $display_at_max = (clone $display_at)->modify("+{$interval}seconds");

        return !DB::table("queue_elements")->whereBetween("display_at", [$display_at_min, $display_at_max])->limit(1)->count();
    }

    protected function zeroSeconds(DateTime $date) {
        $date->setTime($date->format("H"), $date->format("i"), 0);

        return $date;
    }

    protected function queueNotification(Notification  $n, $try_hard = false) {
        $timeslot = date_create($n->display_from);
        $display_till = date_create($n->display_till);
        $this->zeroSeconds($timeslot);

        Log::debug("N{$n->id} for time {$timeslot->format("H:i")} - {$display_till->format("H:i")}");

        while ($timeslot < $display_till && !$this->isTimeslotSafe($timeslot, $this->normalInterval)) {
            $timeslot->modify("+{$this->normalInterval}seconds");

            if ($timeslot > $display_till) {
                $timeslot = clone $display_till;
            }

            Log::debug("normally adjusted timeslot to {$timeslot->format("H:i")}");
        }

        if (!$this->isTimeslotSafe($timeslot, $this->minInterval) && $try_hard) {
            Log::debug("Failed, will try at reduced intervals");

            $timeslot = date_create($n->display_from);
            $this->zeroSeconds($timeslot);

            while ($timeslot < $display_till && !$this->isTimeslotSafe($timeslot, $this->minInterval)) {
                $timeslot->modify("+{$this->minInterval}seconds");

                if ($timeslot > $display_till) {
                    $timeslot = clone $display_till;
                }

                Log::debug("tryharded timeslot to {$timeslot->format("H:i")}");
            }
        }

        if ($this->isTimeslotSafe($timeslot, $this->minInterval)) {
            Log::debug("Timeslot {$timeslot->format("H:i")} is safe, saving");

            $n->queued()->create(["display_at" => $timeslot]);
            $n->save();

            return true;
        }

        Log::debug("Timeslot {$timeslot->format("H:i")} failed to fit");

        return false;
    }
}
