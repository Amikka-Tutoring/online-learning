<?php

namespace App\Http\Controllers;

use App\Models\StudentLayerQuestion;
use App\Models\Video;
use App\Models\VideoResponse;
use App\Notifications\QuestionResponded;
use App\Scopes\VideoScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Notification;

class TutorController extends Controller
{
    public function studentQuestions()
    {
        if (Auth::user()->is_tutor() || Auth::user()->is_admin()) {
            $questions = StudentLayerQuestion::with(['user', 'video' => function ($query) {
                $query->withoutGlobalScopes([VideoScope::class]);
            }, 'video.layer', 'video.responses', 'response', 'response.user'])->get();
            return Inertia::render('Tutor/StudentQuestions', ['questions' => $questions]);
        } else {
            abort(403);
        }
    }

    public function storeResponse(Request $request)
    {
        if (Auth::user()->is_tutor() || Auth::user()->is_admin()) {
            $request->validate([
                'title' => 'required',
                'message' => 'required',
                'video_id' => 'required|exists:videos,id',
                'question_id' => 'required|exists:student_layer_questions,id',
            ]);
            $response = VideoResponse::create([
                'title' => $request->title,
                'url' => $request->url,
                'message' => $request->message,
                'video_id' => $request->video_id,
                'question_id' => $request->question_id,
                'user_id' => Auth::id()
            ]);
            $details = [
                'title' => 'Question Responded',
                'question' => $response->question->question_text,
                'link' => route('video.response', ['video' => $response->video, 'response' => $response])
            ];
            Notification::send($response->question->user, new QuestionResponded($details));
            return ['message' => 'Success'];
        } else {
            abort(403);
        }
    }
}
