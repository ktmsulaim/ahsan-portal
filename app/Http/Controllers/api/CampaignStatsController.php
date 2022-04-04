<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\User;

class CampaignStatsController extends Controller
{
    public function batchWiseTotalAmount()
    {
        $batches = User::select('batch')->groupBy('batch')->get();
        $camp = Campaign::current();
        $data = "*" . $camp->name . "*\n";
        $data .= "\nTotal Amount Sponsored: *₹" . number_format($camp->totalAmount()) . "*\n";
        $data .= "\nTotal Amount Received: *₹" . number_format($camp->totalAmount('received')) . "*\n";
        $data .= "\nTotal Amount Remaining: *₹" . number_format($camp->totalAmount('all') - $camp->totalAmount('received')) . "*\n";
        $data .= "\n\n";

        if ($batches) {
            foreach ($batches as $batch) {
                $data .= "*" . $batch->batch . "*\n\n";

                $members = User::where('batch', $batch->batch)->get();

                if ($members) {
                    $i = 1;
                    foreach ($members as $member) {
                        $total_amount = $member->totalAmount();
                        $data .= $i . '. ' . $member->name . ($total_amount > 0 ? " - *₹" . number_format($member->totalAmount($camp->id)) : '') . "*\n";
                        $i++;
                    }
                }

                $data .= "\n\n";
            }
        }

        return response()->json($data);
    }
}
