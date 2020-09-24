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

        $response = Http::get("https://donate.qiwi.com/api/stream/v1/widgets/$token/events?limit=50");

        if ($response->successful()) {
            $responseJson = $response->json();
            foreach ($responseJson["events"] as $event) {
                $event_id = "eventExtId";

                $donation = Donation::firstOrCreate(["donate_id" => $event_id], [
                    "donate_id" => $event_id,
                    "person" => $event["attributes"]["DONATION_SENDER"] ?? "Аноним",
                    "message" => $event["attributes"]["DONATION_MESSAGE"] ?? "Решил промолчать",
                    "sum" => $event["attributes"]["DONATION_AMOUNT"] ?? 0,
                    "currency" => $event["attributes"]["DONATION_CURRENCY"] ?? "",
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
