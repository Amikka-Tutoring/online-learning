<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPracticeExamDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_id',
        'date_time'
    ];
}
