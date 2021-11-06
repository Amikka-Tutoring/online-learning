<?php

namespace App\Http\Controllers;

use App\Models\StudentLayerQuestion;
use App\Models\Video;
use App\Models\VideoResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TutorController extends Controller
{
    public function studentQuestions()
    {
        $questions = StudentLayerQuestion::with('user', 'video', 'video.layer', 'video.responses', 'response', 'response.user')->get();
        return Inertia::render('Tutor/StudentQuestions', ['questions' => $questions]);
    }

    public function storeResponse(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'message' => 'required',
            'video_id' => 'required|exists:videos,id',
            'question_id' => 'required|exists:student_layer_questions,id',
        ]);
        VideoResponse::create([
            'title' => $request->title,
            'url' => $request->url,
            'message' => $request->message,
            'video_id' => $request->video_id,
            'question_id' => $request->question_id,
            'user_id' => Auth::id()
        ]);
        return ['message' => 'Success'];
    }
}
