<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $casts = [
        'settings'  =>  'array'
    ];


    public static function checkClassTime(){

    	$setting = self::whereName('class_time')->first();

        $start = date('H',strtotime($setting->settings['from_time'].' '.$setting->settings['from_am']));
        $end = date('H',strtotime($setting->settings['to_time'].' '.$setting->settings['to_am']));
       
        if((date('H') < $start) || (date('H') > $end)){
            
            return 'time';
        }
    }
}
