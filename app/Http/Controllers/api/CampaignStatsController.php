<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Http\Request;

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
                        $data .= $i . '. ' . $member->name . ($total_amount > 0 ? " - *₹" . number_format($member->totalAmount($camp->id)) . '*' : '') . "\n";
                        $i++;
                    }
                }

                $data .= "\n";
                $batch_total = Sponsor::totalAmountByBatch($camp->id, $batch->batch);

                if ($batch_total) {
                    $batch_total = $batch_total->amount;
                }

                $data .= "\n------------------------------------------------------------\n";
                $data .= "*Total: ₹" . ($batch_total ? number_format($batch_total) : 0) . "*";
                $data .= "\n------------------------------------------------------------\n";

                $data .= "\n\n";
            }
        }

        return response()->json($data);
    }

    public function batchWiseNotReceived()
    {
        $batches = User::select('batch')->groupBy('batch')->get();
        $camp = Campaign::current();
        $data = "*" . $camp->name . "*\n\n";
        $title = "Batch Wise Amount Not Received";

        $data .= "```" . $title . "```\n\n";

        if ($batches) {
            foreach ($batches as $batch) {
                $data .= "*" . $batch->batch . "*\n\n";

                $members = User::where('batch', $batch->batch)->get();

                if ($members) {
                    $i = 1;
                    foreach ($members as $member) {
                        $total_amount = $member->totalAmount($camp->id, 0);
                        $data .= $i . '. ' . $member->name . ($total_amount > 0 ? " - *₹" . number_format($total_amount) . '*' : '') . "\n";
                        $i++;
                    }
                }

                $data .= "\n";
                $batch_total = Sponsor::totalAmountByBatch($camp->id, $batch->batch, 0);

                if ($batch_total) {
                    $batch_total = $batch_total->amount;
                }

                $data .= "\n------------------------------------------------------------\n";
                $data .= "*Total: ₹" . ($batch_total ? number_format($batch_total) : 0) . "*";
                $data .= "\n------------------------------------------------------------\n";

                $data .= "\n\n";
            }
        }

        return response()->json($data);
    }

    public function toppers(Request $request)
    {
        $camp = Campaign::current();
        $data = "*" . $camp->name . "*\n\n";
        $title = "Toppers";

        $data .= "```" . $title . "```\n\n";

        $data .= "*Top 10*\n\n";
        $toppers = User::toppers($request->get('limit', 10));

        if ($toppers) {
            $i = 1;
            foreach ($toppers as $topper) {
                $data .= $i . '. ' . $topper->name . " - *₹" . number_format($topper->total_amount) . '*' . "\n";
                $i++;
            }
        }

        return response()->json($data);
    }
}
