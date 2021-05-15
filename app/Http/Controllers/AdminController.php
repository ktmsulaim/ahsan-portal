<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Http\Request;

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
}
