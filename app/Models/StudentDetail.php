<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'centre',
        'classes',
        'parent_details',
        'p1_type',
        'p1_first_name',
        'p1_last_name',
        'p1_email',
        'p1_mobile',
        'p2_type',
        'p2_first_name',
        'p2_last_name',
        'p2_email',
        'p2_mobile',
        'remarks',
        'e_person_name',
        'e_person_phone',
        'e_person_email',
        'main_school',
        'main_class'
    ];
    protected $casts = [
        //'parent_details'  =>  'array',
        'assigned_kids'   =>  'array'
    ];

    public function studentclasses()
    {
       return $this->hasOne(Classes::class, 'id','classes');
    }

    public function centres()
    {
       return $this->hasOne(Centre::class,'id','centre');
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public static function checkAssigned($number){

        $students = StudentDetail::where('p1_mobile' ,$number)->pluck('user_id')->all();
        $implode = implode(",",$students);
        $allcheck = StudentDetail::where('assigned_kids',$implode)->first();

        return $allcheck;

    }


}
