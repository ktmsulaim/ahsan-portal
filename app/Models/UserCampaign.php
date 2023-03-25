<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserCampaign extends Pivot
{
    use HasFactory;

    protected $table = "user_campaigns";
    protected $guarded = [];
}
