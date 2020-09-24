<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\QueueElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DonationsController extends Controller
{
    public function index() {
        $token = config_get("donate.key");
        
        $response = Http::get("https://donate.qiwi.com/api/stream/v1/statistics/$token/last-messages?limit=20");

        if ($response->successful()) {
            $responseJson = $response->json();

            foreach ($responseJson["messages"] as $event) {
                $event_id = $event["messageExtId"];

                $donation = Donation::firstOrCreate(["donate_id" => $event_id], [
                    "donate_id" => $event_id,
                    "person" => $event["senderName"] ?? "Аноним",
                    "message" => $event["message"] ?? "Решил промолчать",
                    "sum" => $event["amount"]["value"] ?? 0,
                    "currency" => $event["amount"]["currency"] ?? "",
                ]);

                $donation->save();
            }
        }

        return view("donations.index", ["donations" => Donation::all()]);
    }

    public function toggle($id) {
        /** @var Donation $don */
        $don = Donation::find($id);

        $don->approved = !$don->approved;
        $don->save();

        return redirect()->route('donations')
            ->with('success', "Toggled to {$don->approved}");
    }
}
