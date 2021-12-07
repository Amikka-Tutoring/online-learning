<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'diagnostic_quiz_id'
    ];

    public function quiz()
    {
        return $this->belongsTo(DiagnosticQuiz::class, 'diagnostic_quiz_id');
    }
}
