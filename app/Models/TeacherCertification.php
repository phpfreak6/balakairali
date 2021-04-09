<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherCertification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'detail',
        'certification_status',
        'expiry'
    ];
}
