<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'dob',
        'photo',
        'adno',
        'batch',
        'dhiu_dept',
        'dhiu_adno',
        'dhiu_batch',
        'father_name',
        'mother_name',
        'district',
        'address1',
        'address2',
        'phone_home',
        'phone_personal',
        'marital_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($val)
    {
        if($val) {
            $this->attributes['password'] = bcrypt($val);
        }
    }

    public function getPhotoAttribute($val)
    {
        if($val) {
            return Storage::url($val);
        }
    }
}
