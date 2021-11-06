<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'message',
        'video_id',
        'question_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
