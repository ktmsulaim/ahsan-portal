<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Http\Request;

class UserCampaignsController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::orderBy('id', 'desc')->get();

        return view('user.campaigns.index', compact('campaigns'));
    }

    public function show(Campaign $campaign)
    {
        $targetMetCount = User::usersWithTargetMetCount($campaign->individualTarget(''), $campaign->id);
        $targetMetPercentage = $targetMetCount > 0 ? ($targetMetCount * 100) / User::count() : 0;
        $topAmount = User::topAmountOfCampaign($campaign->id);
        $toppers = User::toppers(10, $campaign);

        return view('user.campaigns.view', compact('campaign', 'targetMetCount', 'targetMetPercentage', 'topAmount', 'toppers'));
    }

    public function sponsors(Request $request, Campaign $campaign)
    {
        $user = User::find(auth()->id());
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $sponsorGroup = Sponsor::where(['user_id' => $user->id, 'campaign_id' => $campaign->id]);
        $totalRecords = $sponsorGroup->count();

        $totalRecordswithFilter = $sponsorGroup->where(function ($query) use ($searchValue) {
            return $query->where('name', 'like', "%$searchValue%")
                ->orWhere('place', 'like', "%$searchValue%")
                ->orWhere('amount', 'like', "%$searchValue%");
        })->count();

        // Fetch records
        $sponsors = $sponsorGroup->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
                return $query->where('name', 'like', "%$searchValue%")
                    ->orWhere('place', 'like', "%$searchValue%")
                    ->orWhere('amount', 'like', "%$searchValue%");
            })
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($sponsors as $key => $sponsor) {
            $data_arr[] = array(
                "id" => $sponsor->id,
                "name" => $sponsor->name,
                "place" => $sponsor->place,
                "phone" => $sponsor->phone,
                "amount" => number_format($sponsor->amount),
                "amount_received" => $sponsor->amount_received,
                "created_at" => $sponsor->created_at->format('Y') != date('Y') ? $sponsor->created_at->format('d F, Y') : $sponsor->created_at->format('d F'),
                "verification" => $sponsor->verification,
                "urls" => [
                    'view' => route('user.sponsors.show', $sponsor->id),
                    'edit' => route('user.sponsors.edit', $sponsor->id)
                ]
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }
}
