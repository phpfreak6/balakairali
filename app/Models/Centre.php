<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centre extends Model {

    use HasFactory;
    protected $fillable = [
        'name',
        'address',
    ];
    

    public function users() {

        return $this->belongsToMany(User::class);

    }

    public function students() {

        return $this->hasMany(StudentDetail::class,'centre','id');

    }

    public function classes() {

        return $this->hasMany(Classes::class);

    }

    /* Active Teachers */
    public function activeTeacher($centre_id) {

        $centre = self::whereId($centre_id)->first();

        return $centre->users->where('status','1')->count();
    }

    /* Active Teachers */
    public function activeStudent($centre_id) {

        $centre = self::whereId($centre_id)->first();

        $ids = $centre->students->pluck('user_id');

        return User::whereIn('id',$ids)->whereStatus('1')->count();
    }
}
