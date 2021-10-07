<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticeExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'subject'
    ];

    public function exams_visited()
    {
        return $this->hasMany(UserExamVisit::class, 'exam_id', 'id');
    }
}
