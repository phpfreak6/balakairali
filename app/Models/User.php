<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable
{

    use HasFactory,
        Notifiable;

    const ADMIN = '1';
    const TEACHER = '2';
    const STUDENT = '3';
    const ROLES = ['1' => 'admin', '2' => 'teacher', '3' => 'student'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'mobile',
        'gender',
        'dob',
        'postcode',
        'state',
        'suburb',
        'address',
        'pin',
        'role',
        'access_login'
    ];
    protected $hidden = [
        'password',
        'remember_token',
        'pin'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function role()
    {

        return self::ROLES[auth()->user()->role];
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function isAdmin()
    {
        if ($this->role == '1')
            return true;
    }

    public function isTeacher()
    {
        if ($this->role == '2')
            return true;
    }

    public function isStudent()
    {
        if ($this->role == '3')
            return true;
    }

    public function student()
    {
        return $this->hasOne(StudentDetail::class);
    }

    public function centres()
    {
        return $this->belongsToMany(Centre::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Classes::class);
    }

    public function certifications()
    {
        return $this->hasMany(TeacherCertification::class);
    }

    /* Student Marks Relation */

    public function marks()
    {

        return $this->hasMany(Mark::class);
    }

    /* Student Fee Relation */

    public function fees()
    {

        return $this->hasOne(Fee::class);
    }

    /* Student Attendance */

    public function attend()
    {

        return $this->hasMany(Attendance::class);
    }

    /* Student Login Record */

    public function loginRecords()
    {

        return $this->hasMany(loginRecord::class);
    }

    /* Current Terms */

    public function currentTerm()
    {

        return $this->hasMany(Attendance::class);
    }

    /* No paid for last term total count */

    public static function notPaidTotalCount()
    {
        if (date('Y-m-d') > '2021-03-31') {
            return self::whereDoesntHave('fees', function ($q) {
                $q->where('pay_year', date("Y"));
                $q->where('pay_term', Quarter::previousTerm());
            })->count();
        } else {
            return 0;
        }
    }

    public static function hasPermission($expression)
    {
        if (in_array($expression, Auth::user()->permissions->pluck('name')->all())) {
            return true;
        } else {
            return false;
        }
    }

    public static function pinCreatedOrNot($parent_mobile_number)
    {
        $ids = StudentDetail::where('p1_mobile', $parent_mobile_number)->pluck('user_id')->all();
        $students = User::whereIn('id', $ids)->whereNotNull('pin')->count();
        if ($students > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function totalStudent()
    {

        return self::whereRole(self::STUDENT)->count();
    }

    public static function totalTeacher()
    {

        return self::whereRole(self::TEACHER)->count();
    }

    public static function todaySigninSignoutStatus($student_id)
    {

        $record = loginRecord::where('user_id', $student_id)->whereDate('created_at', date('Y-m-d'))->first();

        if (empty($record->login_time) && empty($record->logout_time)) {

            return 'Not Signed In';
        } elseif (!empty($record->login_time) && empty($record->logout_time)) {

            return 'Signed In';
        } elseif (!empty($record->login_time) && !empty($record->logout_time)) {

            return 'Signed Out';
        }
    }
}
