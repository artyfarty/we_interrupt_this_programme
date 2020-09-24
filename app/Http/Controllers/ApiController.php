<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\ProgramEvent;
use App\Models\QueueElement;
use App\Repositories\QueueRepository;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    /**
     * @var QueueRepository
     */
    protected $queueRepository;

    public function __construct(QueueRepository $queueRepository) {
        $this->queueRepository = $queueRepository;
    }

    public function poll($password, $auto_ack = 1) {
        if ($password !== env("WITP_PASSWORD")) {
            return ["error" => "403"];
        }

        if (!config_get("queue.enable")) {
            return ["error" => "disabled"];
        }

        $qe = $this->queueRepository->now();


        $cfg = [
            "duration"  => +config_get("queue.display.duration"),
            "poll"      => +config_get("queue.display.poll")
        ];

        $result = [
            "config" => $cfg,
        ];

        if ($qe) {
            $notification = Notification::find($qe->notification_id);
            $program      = ProgramEvent::find($notification->program_event_id);

            $msg = [
                "id"       => +$qe->id,
                "type"     => $notification->type,
                "caption"  => $notification->caption,
                "headline" => $notification->headline,
                "text"     => $notification->text
            ];

            if ($notification->type == "schedule" && $program) {
                $msg["event_time"] = date_create($program->begin_at)->format("H:i");
            }

            if ($notification->type == "list") {
                $msg["lines"] = explode("\n", $notification->text);
                unset($msg["text"]);
            }

            if ($notification->type == "donation") {
                $msg["amount"]   = +$notification->donation->sum;
                $msg["currency"] = $notification->donation->currency;
            }

            if ($auto_ack) {
                $qe->was_displayed = true;
                $qe->save();
            }
            $result["message"] = $msg;
        }

        return $result;
    }

    public function ack($id, $password) {
        if ($password !== env("WITP_PASSWORD")) {
            return ["error" => "403"];
        }

        $qe = QueueElement::find($id);
        $qe->was_displayed = true;
        $qe->save();

        return [
            "id" => $id,
            "result" => true
        ];
    }
}
