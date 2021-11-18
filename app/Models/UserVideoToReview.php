<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVideoToReview extends Model
{
    use HasFactory;

    protected $table = 'user_videos_to_reviews';


    protected $fillable = [
        'user_id',
        'video_id'
    ];
}
