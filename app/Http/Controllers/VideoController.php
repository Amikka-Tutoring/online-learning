<?php

namespace App\Http\Controllers;

use App\Models\UserViewedVideo;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function view(Video $video)
    {
        UserViewedVideo::updateOrCreate([
            'user_id' => auth()->user()->id,
            'video_id' => $video->id
        ], [
            'user_id' => auth()->user()->id,
            'video_id' => $video->id
        ]);
        return ['message' => 'Success'];
    }
}
