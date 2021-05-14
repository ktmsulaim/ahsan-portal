<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Campaign extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function sponsors()
    {
        return $this->hasMany(Sponsor::class);
    }

    public function getLogoAttribute($val)
    {
        if($val) {
            return Storage::url($val);
        }
    }

    public function logo()
    {
        if($this->logo && Storage::exists('campaigns/' . basename($this->logo))) {
            return $this->logo;
        } else {
            return asset('assets/images/470x290.png');
        }
    }

    public function totalAmount()
    {
        if($this->sponsors()->exists()) {
            return $this->sponsors->sum('amount');
        } else {
            return 0;
        }
    }

    public function totalAmountPercentage()
    {
        if($this->totalAmount() > 0) {
            return ($this->totalAmount() * 100) / $this->target;
        } else {
            return 0;
        }
    }

    public function individualTarget($thousands_seperator = ',')
    {
        $totalUsers = User::count();
        
        if($totalUsers > 0) {
            return number_format($this->target / $totalUsers, 2, '.', $thousands_seperator);
        } else {
            return 0;
        }
    }
}
