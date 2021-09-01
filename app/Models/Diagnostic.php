<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function questions()
    {
        return $this->morphMany(Question::class, 'questionable');
    }

    public function quizzes()
    {
        return $this->hasMany(DiagnosticQuiz::class);
    }
}
