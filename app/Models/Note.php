<?php

namespace App\Models;

use App\Scopes\LayerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'written_notes',
        'audio_notes',
        'video_id',
        'user_id'
    ];

//    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
