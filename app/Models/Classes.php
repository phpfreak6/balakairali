<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Holiday;

class Classes extends Model {

    use HasFactory;

    protected $table = 'classes';
    
    protected $fillable = [
        'name'
    ];

    public function users() {

        return $this->belongsToMany(User::class);

    }

    public static function totalClasses($start, $end) {

        $holiday = Holiday::where('year',date('Y'))->first();
        
        $holidays=explode(',',$holiday->holiday['holidays']);

        $totalClasses=0;

        $begin = new \DateTime($start);
        $end = new \DateTime($end);
        
        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($begin, $interval, $end);
        
        foreach($period as $allDt)
        {
        
            $curDate=$allDt->format("Y-m-d");

            if(!in_array($curDate,$holidays))
            {
                $totalClasses++;
            }
        }

        return $totalClasses;

    }

    public function centre() {

        return $this->belongsTo(Centre::class);

    }
    
}
