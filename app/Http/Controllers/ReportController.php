<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Sponsor;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReportController extends Controller
{
    public function index()
    {
        $camp = Campaign::current();
        return view('admin.reports.index', compact('camp'));
    }

    public function show(Request $request)
    {
        $name = $request->get('name');
        $data = null;
        $camp = Campaign::current();

        if(!$name) {
            Toastr::error('Unable to find the report', 'Report not found');
            return Redirect::route('admin.reports.index');
        }

        if($name == 'toppers') {
            $count = $request->get('count');

            if(!$count) {
                $count = 10;
            }

            $data = User::toppers($count);
        } elseif($name == 'amount_not_received') {
            $data = Sponsor::where(['campaign_id' => $camp->id, 'amount_received' => 0])->orderBy('amount', 'desc')->get();
        } elseif($name == 'members_with_zero') {
            $data = User::doesntHave('sponsors')->get();
        } elseif($name == 'toppers_each_batch') {
            $batches = User::select('batch')->groupBy('batch')->orderBy('batch')->get();

            if($batches) {
                $data = [];
                foreach($batches as $batch) {
                    array_push($data, User::topOfBatch($batch->batch));
                }
            }
        }

        return view('admin.reports.single', compact('name', 'data'));
    }
}
