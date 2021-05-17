<?php

namespace App\Http\Controllers;

use App\Exports\SponsorsExport;
use App\Models\Campaign;
use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class SponsorsExportController extends Controller
{
    public function export(Request $request, Campaign $campaign)
    {
        $name = $campaign->name;

        $mode = $request->has('mode') ? $request->get('mode') : 'all';
        
        $user_id = $request->has('user_id') ? $request->get('user_id') : null;
        
        if($mode == 'member' || $mode == 'admin.member') {
            $user = auth()->user()->name;

            if(!$user && $request->has('user_id')) {
                $user = User::find($request->get('user_id'));
                $user = $user->name;
            }

            $name .= ' | ' . $user;
        }
        
        return Excel::download(new SponsorsExport($campaign, $mode, $user_id), $name .'.xlsx');
    }
}
