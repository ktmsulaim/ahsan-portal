<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $campaign = Campaign::current();
        $toppers = User::toppers();
        
        return view('home', compact('campaign', 'toppers'));
    }

    public function profile()
    {
        $user = auth()->user();

        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(auth()->id());

        $validations = [
            'name' => 'required|max:25',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'dob' => 'required',
            'photo' => '',
            'adno' => 'required|integer',
            'batch' => 'required',
            'dhiu_dept' => 'required',
            'dhiu_adno' => 'required',
            'dhiu_batch' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'district' => 'required',
            'address1' => 'required',
            'address2' => '',
            'phone_home' => '',
            'phone_personal' => 'required',
            'marital_status' => 'integer'
        ];

        $request->validate($validations);

        $user->update($request->all());

        $this->uploadImage($user);

        Toastr::success('The account was updated', 'Updated');

        return Redirect::back();
    }

    private function uploadImage($user)
    {
        
        if (request()->hasFile('photo') && request()->file('photo')->isValid()) {
            //check it has already image
            $oldImage = basename($user->photo);
            
            // if already one image before delete it after successful uploading
            if ($oldImage && Storage::exists('photos/'.$oldImage)) {
                Storage::delete('photos/'.$oldImage);
            }
            
            $filename = Storage::putFile('photos', request()->file('photo'));

            $user->photo = $filename;
            $user->save();

        }
    }

    public function changePassword()
    {
        return view('user.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        
        $user = User::find(auth()->id());
        $currentPassword = $request->get('current_password');

        if(!Hash::check($currentPassword, $user->password)) {
            Toastr::warning('Current password is not valid', 'Password mismatch');
            return Redirect::back();
        }

        $user->password = $request->get('password');
        $user->save();

        Toastr::success('Password has been changed', 'Password changed');
        return Redirect::route('home');
    }
}
