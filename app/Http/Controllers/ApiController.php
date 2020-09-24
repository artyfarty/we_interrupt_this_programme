<?php

namespace App\Http\Controllers;

use App\Models\QueueElement;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function poll($password, $auto_ack = 1) {
        if ($password !== env("WITP_PASSWORD")) {
            return ["error" => "403"];
        }

        if (!config_get("queue.enable")) {
            return ["error" => "disabled"];
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

        $msg = [
            "id" => +$qe->id,
            "type" => $qe->notification->type,
            "caption" => $qe->notification->caption,
            "headline" => $qe->notification->headline,
            "text" => $qe->notification->text
        ];

        if ($qe->notification->type == "schedule" && $qe->notification->program_event_id) {
            $msg["event_time"] = date_create($qe->notification->program()->get("begin_at")->first())->format("H:i");
        }

        if ($qe->notification->type == "list") {
            $msg["lines"] = explode("\n", $qe->notification->text);
            unset($msg["text"]);
        }

        if ($qe->notification->type == "donation") {
            $msg["amount"] = +$qe->notification->donation->sum;
            $msg["currency"] = $qe->notification->donation->currency;
        }

        if ($auto_ack) {
            $qe->was_displayed = true;
            $qe->save();
        }

        return ["message" => $msg];
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
