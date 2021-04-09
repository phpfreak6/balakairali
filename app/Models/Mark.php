<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'centre',
        'classes',
        'test',
        'obtained_marks',
        'test_total_marks',
        'date_of_test',
        'term',
        'year'
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }
}
