<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::orderBy('id', 'desc')->get();

        return view('admin.campaigns.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.campaigns.create');
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
            'name' => 'required',
            'description' => 'required',
            'target' => 'required|numeric',
            'logo' => ''
        ]);

        $campaign = Campaign::create($request->all());

        $this->clearDefault($campaign->id);

        $this->uploadImage($campaign);

        Toastr::success('The campaign was successfully added', 'Added');

        return Redirect::route('admin.campaigns.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        $targetMetCount = User::usersWithTargetMetCount($campaign->individualTarget(''));
        $targetMetPercentage = $targetMetCount > 0 ? ($targetMetCount * 100) / User::count() : 0;
        $topAmount = User::topAmountOfCampaign($campaign->id);
        $toppers = User::toppers();

        return view('admin.campaigns.view', compact('campaign', 'targetMetCount', 'targetMetPercentage', 'topAmount', 'toppers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'target' => 'required|numeric',
            'logo' => ''
        ]);

        $campaign->update($request->all());

        $this->clearDefault($campaign->id);

        $this->uploadImage($campaign);

        Toastr::success('The campaign was updated successfully!', 'Updated');

        return Redirect::route('admin.campaigns.show', $campaign->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        if ($campaign->logo) {
            $logo = 'campaigns/' . basename($campaign->logo);
            if(Storage::exists($logo)) {
                Storage::delete($logo);
            }
        }

        $campaign->delete();

        
        if($campaign->active == 1) {
            // if was an active camp then set last camp as active
            $last = Campaign::orderBy('id', 'desc')->first();
            
            if($last) {
                $last->active = 1;
                $last->save();
            }
        }

        Toastr::success('The campaign was deleted', 'Deleted');
        return Redirect::route('admin.campaigns.index');
    }

    private function uploadImage($campaign)
    {
        
        if (request()->hasFile('logo') && request()->file('logo')->isValid()) {
            //check it has already image
            $oldImage = basename($campaign->logo);
            
            // if already one image before delete it after successful uploading
            if ($oldImage && Storage::exists('campaigns/'.$oldImage)) {
                Storage::delete('campaigns/'.$oldImage);
            }
            
            $filename = Storage::putFile('campaigns', request()->file('logo'));

            $campaign->logo = $filename;
            $campaign->save();

        }
    }

    private function clearDefault($campaignId) {
        if(request()->get('active') == 1) {
            Campaign::where('id', '!=', $campaignId)->each(function($camp) {
                $camp->active = 0;
                $camp->save();
            });
        }
    }
}
