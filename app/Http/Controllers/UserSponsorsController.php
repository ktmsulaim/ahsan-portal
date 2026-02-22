<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserSponsorsController extends Controller
{
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

        Toastr::success('The sposor was added successfully', 'Added');

        return Redirect::back();
    }

    public function show(Sponsor $sponsor)
    {
        if ($sponsor->user_id != auth()->id()) {
            Toastr::warning('You have no permission to access to this resource', 'Permission denied');
            return Redirect::route('home');
        }

        return view('user.campaigns.sponsors.view', compact('sponsor'));
    }

    public function edit(Sponsor $sponsor)
    {
        if ($sponsor->user_id != auth()->id()) {
            Toastr::warning('You have no permission to access to this resource', 'Permission denied');
            return Redirect::route('home');
        }

        return view('user.campaigns.sponsors.edit', compact('sponsor'));
    }

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

        Toastr::success('The sposor was updated successfully', 'Updated');

        return Redirect::route('user.sponsors.show', $sponsor->id);
    }
}
