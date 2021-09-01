<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticQuiz extends Model
{
    use HasFactory;

//    protected $primaryKey = 'slug';

    protected $fillable = [
        'name',
        'slug',
        'diagnostic_id'
    ];

    public function questions()
    {
        return $this->morphMany(Question::class, 'questionable');
    }

    public function diagnostic()
    {
        return $this->belongsTo(Diagnostic::class);
    }
}
