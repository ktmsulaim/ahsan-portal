<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AdminUsersController extends Controller
{
    public function index()
    {
        return view('admin.members.index');
    }

    public function dtIndex(Request $request, $batch)
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

         // Total records
         $totalRecords = User::where('batch', $batch)->count();
         $totalRecordswithFilter = User::where('batch', $batch)->where('name', 'like', "%$searchValue%")->count();
         // Fetch records
        $users = User::orderBy($columnName,$columnSortOrder)
        ->where('batch', $batch)
        ->where('name', 'like', '%' .$searchValue . '%')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();
        
        foreach($users as $key => $user){
           $data_arr[] = array(
             "adno" => $user->adno,
             "photo" => $user->photo(),
             "name" => $user->name,
             "phone_personal" => $user->phone_personal,
             "email" => $user->email,
             "url" => [
                 'show' => route('admin.users.show', $user->id),
                 'edit' => route('admin.users.edit', $user->id),
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

    public function import(Request $request)
    {
        if(!$request->hasFile('file') || !$request->file('file')->isValid()) {
            Toastr::error('Please select a file. Or make sure the selected file is valid', 'File error');

            return Redirect::back();
        }

        if(Excel::import(new UsersImport, $request->file('file'))) {
            Toastr::success('The members were successfully imported!', 'Imported');
        } else {
            Toastr::error('Unable to import the members! Try again', 'Failed');
        }

        return Redirect::back();
    }

    public function show(User $user)
    {
        return view('admin.members.view', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.members.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->data('update', $user->id);

        $user->update($request->all());

        $this->uploadImage($user);

        Toastr::success('The member was successfully updated!', 'Updated');
        return Redirect::route('admin.users.show', $user->id);
    }

    public function bulkupdate(Request $request)
    {
        $column = $request->get('column');
        $value = $request->get('value');
        $ids = $request->get('selected');

        if(!$ids || !is_array($ids) || count($ids) == 0) {
            Toastr::error('Select atleast one member to make changes', 'Select member');
            return Redirect::back();
        }

        foreach($ids as $id) {
            $user = User::find($id);
            $user->{$column} = $value;
            $user->save();
        }

        Toastr::success('The members were updated!', 'Updated');
        return Redirect::back();
    }

    public function destroy(User $user)
    {
        if ($user->photo) {
            $photo = 'photos/' . basename($user->photo);
            if(Storage::exists($photo)) {
                Storage::delete($photo);
            }
        }

        $user->delete();

        Toastr::success('The member was successfully deleted!', 'Deleted');
        return Redirect::route('admin.users.index');
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

    private function data($type = 'create', $id = null)
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
            'marital_status' => 'boolean'
        ];

        if ($type == 'update') {
            unset($validations['password']);
            $validations['email'] = 'required|email|unique:users,email,'.$id;
        }
        
        request()->validate($validations);
    }
}
