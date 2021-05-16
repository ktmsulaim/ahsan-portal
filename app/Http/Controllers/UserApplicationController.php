<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserApplication;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.members.applications.index');
    }

    public function dtIndex(Request $request, $status)   
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
         $totalRecords = UserApplication::where('status', $status)->count();
         $totalRecordswithFilter = UserApplication::where('status', $status)->where('name', 'like', "%$searchValue%")->count();
         // Fetch records
        $users = UserApplication::orderBy($columnName,$columnSortOrder)
        ->where('status', $status)
        ->where('name', 'like', '%' .$searchValue . '%')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();
        
        foreach($users as $key => $user){
           $data_arr[] = array(
            "id" => $user->id,
             "adno" => $user->adno,
             "photo" => $user->photo(),
             "name" => $user->name,
             "phone_personal" => $user->phone_personal,
             "batch" => $user->batch,
             "email" => $user->email,
             "url" => [
                 'show' => route('admin.users.applications.show', $user->id),
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

    public function show(UserApplication $userApplication)
    {
        return view('admin.members.applications.view', compact('userApplication'));
    }

   public function updateStatus(Request $request, UserApplication $userApplication)
   {

       if(!$request->has('status')) {
           Toastr::warning('Unable to update the status', 'Update failed');

           return Redirect::back();
       }
       
       $status = $request->get('status');

       $userApplication->status = $status;
       $userApplication->save();

       if((int)$status === 1) {
           // check the applicant has already an account
           $user = User::where('email', $userApplication->email)->first();
            if(!$user) {
                $user = new User();
                $user->name = $userApplication->name;
                $user->email = $userApplication->email;
                $user->password = $userApplication->password;
                $user->photo = $userApplication->photo ? 'photos/'.basename($userApplication->photo) : null;
                $user->dob = $userApplication->dob;
                $user->adno = $userApplication->adno;
                $user->batch = $userApplication->batch;
                $user->dhiu_adno = $userApplication->dhiu_adno;
                $user->dhiu_dept = $userApplication->dhiu_dept;
                $user->dhiu_batch = $userApplication->dhiu_batch;
                $user->father_name = $userApplication->father_name;
                $user->mother_name = $userApplication->mother_name;
                $user->district = $userApplication->district;
                $user->address1 = $userApplication->address1;
                $user->address2 = $userApplication->address2;
                $user->phone_home = $userApplication->phone_home;
                $user->phone_personal = $userApplication->phone_personal;
                $user->marital_status = $userApplication->marital_status;
                $user->save();
            }
       } else {
           // find any user with that info
           $user = User::where('email', $userApplication->email)->first();

           if($user) {
               $user->delete();
           }
       }

       Toastr::success('The application status was updated!', 'Status updated');

       return Redirect::back();
   }
}
