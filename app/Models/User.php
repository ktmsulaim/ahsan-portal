<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
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
        if ($val) {
            $this->attributes['password'] = bcrypt($val);
        }
    }

    public function getPhotoAttribute($val)
    {
        if ($val) {
            return Storage::url($val);
        }
    }

    public function photo()
    {
        if ($this->photo && Storage::exists('photos/' . basename($this->photo))) {
            return $this->photo;
        } else {
            return asset('assets/images/user.png');
        }
    }

    public function sponsors()
    {
        return $this->hasMany(Sponsor::class);
    }

    public static function usersWithTargetMet($target)
    {
        $campaign = Campaign::active()->first();

       return DB::table('sponsors')->select("users.name", "users.id", DB::raw("SUM(sponsors.amount) as total_amount"))
        ->join("users", 'sponsors.user_id', '=', 'users.id')
        ->where('sponsors.campaign_id', $campaign->id)
        ->orderBy("total_amount", "desc")
        ->groupBy('users.id')
        ->havingRaw('total_amount >= ' . $target)
        ->get();
    }


    public static function usersWithTargetMetCount($target)
    {
       return count(self::usersWithTargetMet($target));
    }

    public static function topAmountOfCampaign($campaign)
    {
        return DB::table('sponsors')->select("users.name", "users.id", "sponsors.amount")
        ->join("users", 'sponsors.user_id', '=', 'users.id')
        ->where('sponsors.campaign_id', $campaign)
        ->orderBy("amount", "desc")
        ->first();
    }

    public static function toppers($count = 10)
    {
        $campaign = Campaign::active()->first();

        return DB::table('sponsors')->select("users.name", "users.id", "users.batch", DB::raw("SUM(sponsors.amount) as total_amount"))
        ->join("users", 'sponsors.user_id', '=', 'users.id')
        ->where('sponsors.campaign_id', $campaign->id)
        ->orderBy("total_amount", "desc")
        ->groupBy('users.id')
        ->take($count)
        ->get();
    }
}
