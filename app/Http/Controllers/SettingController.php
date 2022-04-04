<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        try {
            Setting::setMany($request->except('_token'));

            Toastr::success('Settings have been saved', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
