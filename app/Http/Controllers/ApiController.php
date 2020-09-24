<?php

namespace App\Http\Controllers;

use App\Models\QueueElement;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function poll($password) {
        if ($password !== env("WITP_PASSWORD")) {
            return ["NOPE"];
        }

        $now = date_create()->format("Y-m-d H:i:s");

        /** @var QueueElement $qe */
        $qe = QueueElement::all()
            ->where("was_displayed", "=", "0")
            ->where("display_at", "<=", $now)
            ->sortBy("display_at")
            ->first();

        if (!$qe) {
            return [];
        }

        $result = [
            "type" => $qe->notification->type,
            "caption" => $qe->notification->caption,
            "headline" => $qe->notification->headline,
            "text" => $qe->notification->text
        ];

        if ($qe->notification->type == "schedule" && $qe->notification->program_event_id) {
            $result["event_time"] = date_create($qe->notification->program()->get("begin_at")->first())->format("H:i");
        }

        if ($qe->notification->type == "list") {
            $result["lines"] = explode("\n", $qe->notification->text);
            unset($result["text"]);
        }

        $qe->was_displayed = true;
        $qe->save();

        return $result;

    }
}
