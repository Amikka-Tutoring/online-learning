<?php

namespace App\Models;

use App\Scopes\VideoScope;
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

    public function video()
    {
        return $this->belongsTo(Video::class)->withoutGlobalScope(VideoScope::class);
    }

    public function question()
    {
        return $this->belongsTo(StudentLayerQuestion::class, 'question_id');
    }
}
