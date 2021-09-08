<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic',
        'written_notes',
        'audio_notes',
        'layer_id',
        'user_id'
    ];
}
