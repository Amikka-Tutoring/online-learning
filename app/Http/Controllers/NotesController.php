<?php

namespace App\Http\Controllers;

use App\Models\Layer;
use App\Models\Note;
use App\Models\StudentLayerQuestion;
use App\Scopes\LayerScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\throwException;

class NotesController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required',
            'lesson_id' => 'required|exists:layers,id',
        ]);
        $notes = Note::updateOrCreate(
            [
                'layer_id' => $request->lesson_id,
                'user_id' => Auth::id()
            ],
            [
                'written_notes' => $request->note,
                'user_id' => Auth::id(),
                'layer_id' => $request->lesson_id
            ]
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
