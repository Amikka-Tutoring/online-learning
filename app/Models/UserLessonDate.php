<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLessonDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'time',
        'user_id'
    ];
}
