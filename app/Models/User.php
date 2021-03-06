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

    protected $camp;

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->camp = Campaign::current();
    }

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
        'last_login' => 'datetime'
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

    public function totalAmount($camp_id = null, $received = null)
    {
        $camp = $this->camp;

        if ($camp_id) {
            $camp = Campaign::find($camp_id);
        }

        if ($camp && $this->sponsors()->exists()) {
            return $this->sponsors()->where(function ($q) use ($camp, $received) {
                if ($camp) {
                    $q->where('campaign_id', $camp->id);
                }

                if ($received !== null) {
                    $q->where('amount_received', $received);
                }
            })->sum('amount');
        } else {
            return 0;
        }
    }

    public function targetMet($camp_id = null)
    {
        $camp = $camp_id ? Campaign::find($camp_id) : $this->camp;
        $target = $camp->individualTarget('', false);
        $amount = $this->totalAmount($camp_id);

        return $amount >= $target;
    }

    public function totalAmountPercentage($camp_id = null)
    {
        $camp = $camp_id ? Campaign::find($camp_id) : $this->camp;
        $target = $camp ? $camp->individualTarget('', false) : 0;
        $total = $this->totalAmount();

        if ($target > 0 && $total > 0) {
            return ($total * 100) / $target;
        } else {
            return 0;
        }
    }

    public function totalAmountReceived($type = 'amount', $camp_id = null)
    {
        $camp = $camp_id ? Campaign::find($camp_id) : $this->camp;
        if ($this->sponsors()->exists()) {
            $total = $this->totalAmount($camp_id);
            $received = $this->sponsors()->where(['campaign_id' => $camp->id, 'amount_received' => 1])->sum('amount');

            if ($type == 'amount') {
                return $received;
            } elseif ($type == 'percentage') {
                return $total ? ($received * 100) / $total : 0;
            }
        } else {
            return 0;
        }
    }

    public static function usersWithTargetMet($target, $camp_id = null)
    {
        $campaign = $camp_id ? Campaign::find($camp_id) : Campaign::active()->first();

        return DB::table('users')->select(
            "users.name",
            "users.id",
            DB::raw("SUM(sponsors.amount) as total_amount")
        )
            ->join("sponsors", 'sponsors.user_id', '=', 'users.id')
            ->where('sponsors.campaign_id', $campaign->id)
            ->orderBy("total_amount", "desc")
            ->groupBy('users.id')
            ->havingRaw('total_amount >= ' . $target)
            ->get();
    }


    public static function usersWithTargetMetCount($target, $camp_id = null)
    {
        return count(self::usersWithTargetMet($target, $camp_id));
    }

    public static function topAmountOfCampaign($campaign)
    {
        return DB::table('sponsors')->select("users.name", "users.id", "sponsors.amount")
            ->join("users", 'sponsors.user_id', '=', 'users.id')
            ->where('sponsors.campaign_id', $campaign)
            ->orderBy("amount", "desc")
            ->first();
    }

    public static function toppers($count = 10, $campaign = null)
    {
        if (!$campaign) {
            $campaign = (new self)->camp;
        }

        if ($campaign) {
            return DB::table('sponsors')->select("users.name", "users.id", "users.batch", DB::raw("SUM(sponsors.amount) as total_amount"))
                ->join("users", 'sponsors.user_id', '=', 'users.id')
                ->where('sponsors.campaign_id', $campaign->id)
                ->orderBy("total_amount", "desc")
                ->groupBy('users.id')
                ->take($count)
                ->get();
        }
    }

    public static function topOfBatch($batch, $campaign = null)
    {
        if (!$campaign) {
            $campaign = (new self)->camp;
        }

        if ($campaign) {
            return DB::table('sponsors')->select("users.name", "users.id", "users.batch", DB::raw("SUM(sponsors.amount) as total_amount"))
                ->join("users", 'sponsors.user_id', '=', 'users.id')
                ->where('sponsors.campaign_id', $campaign->id)
                ->where('users.batch', $batch)
                ->orderBy("total_amount", "desc")
                ->groupBy('users.id')
                ->first();
        }
    }
}
