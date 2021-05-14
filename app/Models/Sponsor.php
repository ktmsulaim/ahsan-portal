<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sponsor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public static function totalAmountByBatch($camp, $batch)
    {
        return DB::table('sponsors')
                ->select("users.batch", DB::raw('SUM(sponsors.amount) as amount'))
                ->join('users', 'sponsors.user_id', '=', 'users.id')
                ->where('users.batch', $batch)
                ->where('sponsors.campaign_id', $camp)
                ->groupBy('users.batch')
                ->first();
    }
}
