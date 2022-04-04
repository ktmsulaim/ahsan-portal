<?php 

use App\Models\Setting;

if(!function_exists('setting')) {
    function setting($key, $default = null)
    {
        if(!is_null($key)) {
            if(is_array($key)) {
                Setting::set($key['key'], $key['value']);
            }

            return Setting::get($key, $default);
        }
    }
}