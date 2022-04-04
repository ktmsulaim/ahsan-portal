<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getValueAttribute($value)
    {
        return unserialize($value);
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = serialize($value);
    }

    public static function firstOrCreate($key, $value = null)
    {
        if (!self::where('key', $key)->exists()) {
            $setting = self::create([
                'key' => $key,
                'value' => $value
            ]);
        } else {
            $setting = self::where('key', $key)->first();
        }

        return $setting;
    }

    public static function set($key, $value)
    {
        $setting = self::firstOrCreate($key);
        $setting->value = $value;
        $setting->save();
    }

    public static function setMany($settings)
    {
        foreach ($settings as $key => $value) {
            self::set($key, $value);
        }
    }

    public static function has($key)
    {
        return static::where('key', $key)->exists();
    }

    public static function get($key, $default = null)
    {
        return self::where('key', $key)->first()->value ?? $default;
    }

    public static function getAllSettingsToJson()
    {
        return self::all(['key', 'value']);
    }
}
