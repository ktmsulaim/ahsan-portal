<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Sponsor;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Campaign $campaign)
    {
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

        // Only allow ordering by actual database columns (urls, user are computed fields)
        $sortableColumns = ['id', 'name', 'place', 'phone', 'amount', 'amount_received', 'created_at', 'verification'];
        $orderColumn = in_array($columnName, $sortableColumns) ? $columnName : 'id';

        // Total records
        $totalRecords = $campaign->sponsors()->count();

        $totalRecordswithFilter = $campaign->sponsors()
            ->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', "%$searchValue%")
                    ->orWhere('place', 'like', "%$searchValue%")
                    ->orWhere('amount', 'like', "%$searchValue%");
            })
            ->count();

        // Fetch records
        $sponsors = $campaign->sponsors()->orderBy($orderColumn, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('place', 'like', '%' . $searchValue . '%')
                    ->orWhere('amount', 'like', '%' . $searchValue . '%');
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
                "user" => [
                    'id' => $sponsor->user->id,
                    'name' => $sponsor->user->name,
                    'link' => route('admin.users.show', $sponsor->user_id)
                ],
                "urls" => [
                    'view' => route('admin.sponsors.show', $sponsor->id),
                    'edit' => route('admin.sponsors.edit', $sponsor->id)
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

    public function byUser(User $user, Campaign $campaign)
    {
        $userCampaign = $user->campaigns()->where('campaigns.id', $campaign->id)->first();
        return view('admin.members.campaigns.view', compact('user', 'campaign', 'userCampaign'));
    }

    public function updateUserCampaignLocation(Request $request, User $user, Campaign $campaign)
    {
        $locations = $campaign->locations ?? [];
        $validLocations = is_array($locations) ? array_keys($locations) : [];
        $location = $request->get('location');

        if (count($validLocations) > 0) {
            $request->validate(['location' => 'required|string|in:' . implode(',', $validLocations)]);
        } else {
            $location = $location ?: 'General';
        }

        $existing = $user->campaigns()->where('campaigns.id', $campaign->id)->first();
        if ($existing) {
            $user->campaigns()->updateExistingPivot($campaign->id, ['location' => $location]);
        } else {
            $user->campaigns()->attach($campaign->id, ['location' => $location]);
        }

        Toastr::success('Location has been set for this campaign.');
        return Redirect::back();
    }

    public function dtByUser(Request $request, User $user, Campaign $campaign)
    {
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

        // Only allow ordering by actual database columns (urls is a computed field)
        $sortableColumns = ['id', 'name', 'place', 'phone', 'amount', 'amount_received', 'created_at', 'verification'];
        $orderColumn = in_array($columnName, $sortableColumns) ? $columnName : 'id';

        // Total records
        $sponsorGroup = Sponsor::where(['user_id' => $user->id, 'campaign_id' => $campaign->id]);
        $totalRecords = $sponsorGroup->count();
        $totalRecordswithFilter = $sponsorGroup->where(function ($query) use ($searchValue) {
            return $query->where('name', 'like', "%$searchValue%")->orWhere('place', 'like', "%$searchValue%");
        })->count();
        // Fetch records
        $sponsors = $sponsorGroup->orderBy($orderColumn, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
                return $query->where('name', 'like', "%$searchValue%")->orWhere('place', 'like', "%$searchValue%");
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
                "created_at" => $sponsor->created_at->format('d F, Y'),
                "verification" => $sponsor->verification,
                "urls" => [
                    'view' => route('admin.sponsors.show', $sponsor->id),
                    'edit' => route('admin.sponsors.edit', $sponsor->id)
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'campaign_id' => 'required',
            'name' => 'required',
            'place' => 'required',
            'phone' => 'required',
            'amount' => 'required',
            'amount_received' => 'required|in:0,1',
            'payment_type' => 'required|in:One time,Recurring',
        ]);

        $data = $request->all();
        if ($request->input('mode') === '' || $request->input('mode') === null) {
            $data['mode'] = 1;
        }
        Sponsor::create($data);

        Toastr::success('The sposor was added successfully');

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor)
    {
        return view('admin.campaigns.sponsors.view', ['sponsor' => $sponsor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor)
    {
        return view('admin.campaigns.sponsors.edit', compact('sponsor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        $request->validate([
            'name' => 'required',
            'place' => 'required',
            'phone' => 'required',
            'amount' => 'required',
            'amount_received' => 'required|in:0,1',
            'payment_type' => 'required|in:One time,Recurring',
        ]);

        $data = $request->all();
        if ($request->input('mode') === '' || $request->input('mode') === null) {
            $data['mode'] = 1;
        }
        $sponsor->update($data);

        Toastr::success('The sponsor has been updated', 'Updated');

        if ($request->has('redirect_url')) {
            return Redirect::to($request->get('redirect_url'));
        } else {
            return Redirect::route('admin.campaigns.show', $sponsor->campaign->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor)
    {
        $sponsor->delete();

        Toastr::success('The sponsor was successfully deleted', 'Deleted');

        return Redirect::route('admin.campaigns.show', $sponsor->campaign->id);
    }
}
