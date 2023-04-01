<?php

namespace App\Http\Controllers;

use App\Models\UserApplication;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class MembershipApplyController extends Controller
{
    public function apply()
    {
        return view('membership.apply');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:25',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
            'dob' => 'required',
            'photo' => '',
            'adno' => 'required|integer',
            'batch' => 'required',
            'dhiu_dept' => 'required',
            'dhiu_adno' => 'required',
            'dhiu_batch' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'state' => 'required',
            'district' => 'required',
            'address1' => 'required',
            'address2' => '',
            'phone_home' => '',
            'phone_personal' => 'required',
            'marital_status' => 'required'
        ]);

        $user = UserApplication::create($request->except('_token', 'password_confirmation'));

        $this->uploadImage($user);

        Toastr::success('The application was submitted!', 'Success');
        return Redirect::route('membership.status')->with('user', $user);
    }

    public function status()
    {
        $user = null;
        $checked = false;
        return view('membership.status', compact('user', 'checked'));
    }

    public function getStatus(Request $request)
    {
        $email = $request->get('email');

        $user = UserApplication::where('email', $email)->first();

        $checked = $request->get('checked');

        return view('membership.status', compact('user', 'checked'));
    }

    private function uploadImage($user)
    {

        if (request()->hasFile('photo') && request()->file('photo')->isValid()) {
            //check it has already image
            $oldImage = basename($user->photo);

            // if already one image before delete it after successful uploading
            if ($oldImage && Storage::exists('photos/' . $oldImage)) {
                Storage::delete('photos/' . $oldImage);
            }

            $filename = Storage::putFile('photos', request()->file('photo'));

            $user->photo = $filename;
            $user->save();
        }
    }
}
