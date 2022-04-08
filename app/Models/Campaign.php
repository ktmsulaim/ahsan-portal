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

    public function scopeEnabled($query)
    {
        return $query->where('status', 1);
    }

    public function sponsors()
    {
        return $this->hasMany(Sponsor::class);
    }

    public function getLogoAttribute($val)
    {
        if ($val) {
            return Storage::url($val);
        }
    }

    public function logo()
    {
        if ($this->logo && Storage::exists('campaigns/' . basename($this->logo))) {
            return $this->logo;
        } else {
            return asset('assets/images/470x290.png');
        }
    }

    public function totalAmount($mode = 'all')
    {
        if ($this->sponsors()->exists()) {
            if ($mode == 'all') {
                return $this->sponsors->sum('amount');
            } elseif ($mode == 'received') {
                return $this->sponsors()->where('amount_received', 1)->sum('amount');
            }
        } else {
            return 0;
        }
    }

    public function totalAmountPercentage($mode =  'all')
    {
        if ($this->totalAmount($mode) > 0) {
            if ($mode == 'all') {
                return ($this->totalAmount($mode) * 100) / $this->target;
            } elseif ($mode == 'received') {
                return ($this->totalAmount('received') * 100) / $this->totalAmount('all');
            }
        } else {
            return 0;
        }
    }

    public function individualTarget($thousands_seperator = ',', $format = true)
    {
        $totalUsers = User::whereYear('created_at', '<=', $this->created_at->year)->count();

        if ($totalUsers > 0) {
            $target = $this->target / $totalUsers;
            if ($format) {
                return number_format($target, 2, '.', $thousands_seperator);
            }

            return $target;
        } else {
            return 0;
        }
    }

    public static function current()
    {
        return self::active()->first();
    }
}
