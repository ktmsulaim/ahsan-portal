<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $password = strtolower(str_replace(' ', '', $row['batch']));
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => $password,
            'dob' => $row['dob'],
            'adno' => $row['adno'],
            'batch' => $row['batch'],
            'dhiu_dept' => $row['dhiu_dept'],
            'dhiu_adno' => (String)$row['dhiu_adno'],
            'dhiu_batch' => (String)$row['dhiu_batch'],
            'father_name' => $row['father_name'],
            'mother_name' => $row['mother_name'],
            'state' => $row['state'],
            'district' => $row['district'],
            'address1' => $row['address1'],
            'address2' => $row['address2'],
            'phone_home' => (String)$row['phone_home'],
            'phone_personal' => $row['phone_personal'],
            'marital_status' => $row['marital_status'] == 'Married' ? 1 : 0,
        ]);
    }

}
