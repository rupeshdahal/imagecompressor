<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = ['id'];

    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        if (!$setting) return $default;
        
        if ($setting->type === 'json' || $setting->type === 'boolean') {
            return json_decode($setting->value, true);
        }
        
        return $setting->value;
    }
}
