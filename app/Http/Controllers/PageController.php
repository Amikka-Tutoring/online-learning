<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Diagnostic;
use App\Models\Layer;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PageController extends Controller
{

    public function test2()
    {
        return Inertia::render('Test2');
    }

    public function initialQuestionnaire()
    {
        if (Auth::user()->profile) {
            return redirect()->route('dashboard');
        }
        return Inertia::render('InitialQuestionnaire');
    }

    public function dashboard()
    {
        $personality = Diagnostic::with('quizzes')->where('name', 'Personality')->first();
        $academic = Diagnostic::with('quizzes')->where('name', 'Academic')->first();

//        dd($academic);
        return Inertia::render('Dashboard', ['personality_data' => $personality, 'academic_data' => $academic]);
    }

    public function profile()
    {

//        $user = auth()->user();
        return Inertia::render('Profile');
    }

    public function mathDiagnostic()
    {
        return Inertia::render('MathDiagnostic');
    }

    public function postMathDiagnostic(Request $request)
    {
        return Inertia::render('DiagnosticResults');
    }

    public function exams()
    {
        return Inertia::render('Exams');
    }

    public function myCourses()
    {
        return Inertia::render('MyCourses');
    }

    public function recommended()
    {
        $courses = Course::with(['layers' => function ($query) {
            $query->whereNull('layers.parent_id')->with(['children', 'children.children', 'videos', 'children.videos', 'children.children.videos']);
        }])->get();

//        dd($courses->first());


//        $course = Course::first()->topLayers()->first();
//        dd($course->children);
        return Inertia::render('Recommended', ['courses' => $courses]);
    }

    public function course()
    {
        return Inertia::render('Course');
    }

    public function calendar()
    {
        return Inertia::render('Calendar');
    }

    public function setCalendar()
    {
        return Inertia::render('SetCalendar');
    }

    public function notesList()
    {
        return Inertia::render('NotesList');
    }

    public function notesBlock()
    {
        return Inertia::render('NotesBlock');
    }

    public function createNotes()
    {
        return Inertia::render('CreateNotes');
    }

    public function oneToOne()
    {
        return Inertia::render('OneToOne');
    }

    public function review()
    {
        return Inertia::render('Review');
    }


    public function test()
    {
        $layer = Layer::find(1);
        $tag = Tag::where('name', 'easy')->first();

        $user = Auth::user();
//        $user->tags()->save($tag);
//        dd($user->tags->pluck('name'));
        $userTag = $user->tags->last();


//        $courses = Course::with(['layers' => function ($query) {
//            $query->whereNull('layers.parent_id')->with(['children', 'children.children', 'videos', 'children.videos', 'children.children.videos']);
//        }])->get();


        $concision = Layer::find(3);
//        $concision->tags()->save($tag);


        $query = $userTag->layers->whereNull('parent_id')->first()->children;
        dd($userTag->layers->first());

//        $layer->tags()->save($tag);
//        dd($userTag->layers);

    }
}
