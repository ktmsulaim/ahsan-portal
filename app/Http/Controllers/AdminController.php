<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Campaign;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index()
    {
        $totalMembers = User::count();
        $totalBatches = User::select('batch')->groupBy('batch')->get();
        $totalCamps = Campaign::enabled()->count();
        $activeCamp = Campaign::current();
        return view('admin.index', compact('totalMembers', 'totalBatches', 'totalCamps', 'activeCamp'));
    }

    public function changePassword()
    {
        return view('admin.auth.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        
        $admin = Admin::find(auth('admin')->id());
        $currentPassword = $request->get('current_password');

        if(!Hash::check($currentPassword, $admin->password)) {
            Toastr::error('Current password is not valid', 'Password mismatch');
            return Redirect::back();
        }

        $admin->password = $request->get('password');
        $admin->save();

        Toastr::success('Password has been changed', 'Password changed');
        return Redirect::route('admin.index');
    }
}
