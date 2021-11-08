<?php

namespace App\Http\Controllers;

use App\Models\Layer;
use App\Models\Note;
use App\Models\StudentLayerQuestion;
use App\Scopes\LayerScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use function PHPUnit\Framework\throwException;

class NotesController extends Controller
{
    public function show(Note $note)
    {
//        dd($note);
        return Inertia::render('SingleNote', ['note' => $note->load('video.layer', 'video.tags')]);
    }

    public function getNote(Note $note)
    {
        return $note->load(['lesson', 'lesson.tags']);
    }

    public function getNotes()
    {
        $user = Auth::user();
        $user->load('enrollments', 'enrollments.course');
        $course = request()->get('course');
        $input = request()->get('input');
        $notes = $user->notes()->whereHas('video.layer.course', function ($query) use ($course) {
            $query->where('name', 'like', '%' . $course . '%');
        })->where('written_notes', 'like', '%' . $input . '%')->with('video.layer', 'video.layer.course', 'video.layer.tags')->get();
        return ['s_notes' => $notes, 'user' => $user, 'course' => $course, 'input' => $input];
    }

    public function notesList()
    {
        $user = Auth::user();
        $user->load('enrollments', 'enrollments.course');
        $course = '';
        $input = '';
        $notes = $user->notes()->whereHas('video.layer.course', function ($query) use ($course) {
            $query->where('name', 'like', '%' . $course . '%');
        })->where('written_notes', 'like', '%' . $input . '%')->with('video.layer', 'video.layer.course', 'video.layer.tags')->get();


        return Inertia::render('NotesList', ['notes' => $notes]);
    }

    public function dashboardNotesByDate()
    {
        $user = Auth::user();
        $notes = $user->notes()->with(['video.layer', 'video.layer.course', 'video.tags'])->get()->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('m/d');
        });
        return ['notes' => $notes];
    }

    public function dashboardNotesByCourse($course)
    {
        $user = Auth::user();
        $notes = $user->notes()->latest()->with(['video.layer', 'video.layer.course', 'video.tags'])->whereHas('video.layer', function ($query) use ($course) {
            $query->whereHas('course', function ($q) use ($course) {
                if ( $course == 'All' )
                    $q->where('name', 'like', '%' . '' . '%');
                else
                    $q->where('name', 'like', '%' . $course . '%');
            });
        })->paginate(12)->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('m/d');
        });
        return ['notes' => $notes];
    }

    public function store(Request $request)
    {
        if ( $request->hasFile('audio_notes') ) {
            $fileName = time() . '_' . $request->audio_notes->getClientOriginalName() . '.mp3';
            $filePath = $request->file('audio_notes')->storeAs('uploads', $fileName, 'public');
            $fullPath = 'storage/' . $filePath;
        }
        Note::updateOrCreate(
            ['video_id' => $request->video_id,
                'user_id' => Auth::id()],
            [
                'written_notes' => $request->written_notes,
                'user_id' => Auth::id(),
                'audio_notes' => $fullPath ?? $request->audio_notes,
                'video_id' => $request->video_id
            ]
        );
        return ['message' => 'Saved Successfully!'];
    }

    public function storeWrittenNotes(Request $request)
    {
        return ['message' => $request->all()];
    }

    public function storeQuestion(Request $request)
    {
        $request->validate([
            'question_text' => 'required',
            'video_id' => 'required|exists:videos,id',
        ]);

        StudentLayerQuestion::create([
            'user_id' => Auth::id(),
            'video_id' => $request->video_id,
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
