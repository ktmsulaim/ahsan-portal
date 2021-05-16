<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UserApplication extends Model
{
    use HasFactory;

    protected $guarded = [];

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
}
