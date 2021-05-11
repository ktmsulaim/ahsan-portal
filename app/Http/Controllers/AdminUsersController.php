<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AdminUsersController extends Controller
{
    public function index()
    {
        return view('admin.members.index');
    }


    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $this->data();

        $user = User::create($request->all());

        $this->uploadImage($user);

        Toastr::success('The member was successfully added!', 'Success');
        return Redirect::route('admin.users.index');
    }

    public function edit(User $user)
    {
        return view('admin.members.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->data('update');

        $user->update($request->all());

        $this->uploadImage($user);

        Toastr::success('The member was successfully updated!', 'Updated');
        Redirect::route('admin.users.show', $user->id);
    }

    public function destroy(User $user)
    {
        if ($user->photo && Storage::exists('photos/' . $user->photo)) {
            Storage::delete('photos/' . $user->photo);
        }

        $user->delete();

        Toastr::success('The member was successfully deleted!', 'Deleted');
        Redirect::route('admin.users.index');
    }

    private function uploadImage($user)
    {
        if (request()->hasFile('photo') && request()->file('photo')->isValid()) {
            //check it has already image
            $oldImage = $user->photo;

            $filename = Storage::put('photos', request()->file('photo'));

            $user->photo = $filename;
            $user->save();

            // if already one image before delete it after successful uploading
            if ($oldImage) {
                Storage::delete('photos/' . $oldImage);
            }
        }
    }

    private function data($type = 'create')
    {
        $validations = [
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
            'district' => 'required',
            'address1' => 'required',
            'address2' => '',
            'phone_home' => '',
            'phone_personal' => 'required',
            'marital_status' => 'required'
        ];

        if ($type == 'update') {
            unset($validations['password']);
        }

        request()->validate($validations);
    }
}
