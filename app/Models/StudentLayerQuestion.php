<?php

namespace App\Models;

use App\Scopes\LayerScope;
use App\Scopes\VideoScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLayerQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'video_id',
        'question_text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id')->withoutGlobalScope(VideoScope::class);
    }

    public function response()
    {
        return $this->hasOne(VideoResponse::class, 'question_id');
    }
}
