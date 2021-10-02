<?php

namespace App\Http\Controllers;

use App\Models\Layer;
use App\Models\Note;
use App\Models\StudentLayerQuestion;
use App\Scopes\LayerScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\throwException;

class NotesController extends Controller
{
    public function getNotes($query)
    {
        $user = Auth::user();
        $notes = $user->notes()->where('written_notes', 'like', $query . '%')->with(['lesson', 'lesson.course', 'lesson.tags'])->get();
        return ['notes' => $notes];
    }

    public function dashboardNotesByDate()
    {
        $user = Auth::user();
        $notes = $user->notes()->with(['lesson', 'lesson.course', 'lesson.tags'])->get()->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('m/d');
        });
        return ['notes' => $notes];
    }

    public function dashboardNotesByCourse($course)
    {
        $user = Auth::user();
        $notes = $user->notes()->with(['lesson', 'lesson.course', 'lesson.tags'])->whereHas('lesson', function ($query) use ($course) {
            $query->whereHas('course', function ($q) use ($course) {
                $q->where('name', 'like', '%' . $course . '%');
            });
        })->get()->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('m/d');
        });
        return ['notes' => $notes];
    }

    public function store(Request $request)
    {
        $request->validate(['note' => 'required',
            'lesson_id' => 'required|exists:layers,id',]);
        $notes = Note::updateOrCreate(
            ['layer_id' => $request->lesson_id,
                'user_id' => Auth::id()],
            ['written_notes' => $request->note,
                'user_id' => Auth::id(),
                'layer_id' => $request->lesson_id]
        );
        return 'Saved Successfully!';
    }

    public function storeQuestion(Request $request)
    {
        $request->validate([
            'question_text' => 'required',
            'lesson_id' => 'required|exists:layers,id',
        ]);

        StudentLayerQuestion::create([
            'user_id' => Auth::id(),
            'layer_id' => $request->lesson_id,
            'question_text' => $request->question_text,
        ]);
        return 'Saved Successfully';
    }

    public function lessonQuestions($id)
    {
        $layer = Layer::withoutGlobalScope(LayerScope::class)->find($id);
        $questions = $layer->studentQuestions()->with(['user', 'layer'])->latest()->get();

        foreach ($questions as $question) {
            print_r('Student: ' . $question->user->name . ', Question: ' . $question->question_text . ', Layer: ' . $question->layer->name . '<br>');
        }
    }
}
