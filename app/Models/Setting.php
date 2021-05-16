<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

    use HasFactory;

    protected $casts = ['settings' => 'array'];

    public static function checkClassTime($current_desktop_time) {
        $setting = self::whereName('class_time')->first();
        $start = date('Y-m-d H:i:s', strtotime($setting->settings['from_time'] . ' ' . $setting->settings['from_am']));
        $end = date('Y-m-d H:i:s', strtotime($setting->settings['to_time'] . ' ' . $setting->settings['to_am']));
        $current_desktop_time = date('Y-m-d H:i:s', floor($current_desktop_time / 1000));
        if (($current_desktop_time < $start) || ($current_desktop_time > $end)) {
            return 'time';
        }
    }

}
