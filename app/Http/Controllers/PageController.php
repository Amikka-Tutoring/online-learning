<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Diagnostic;
use App\Models\Layer;
use App\Models\Tag;
use App\Models\User;
use App\Scopes\LayerScope;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class PageController extends Controller
{

    public function test2()
    {
        return Inertia::render('Test2');
    }

    public function initialQuestionnaire()
    {
        $courses = Course::all();
        if (Auth::user()->profile) {
            return redirect()->route('dashboard');
        }
        return Inertia::render('InitialQuestionnaire', ['courses_data' => $courses]);
    }

    public function dashboard()
    {
        $user_courses = Auth::user()->with(['enrollments', 'enrollments.course'])->first();
        $personality = Diagnostic::with('quizzes')->where('name', 'Personality')->first();
        $academic = Diagnostic::with('quizzes')->where('name', 'Academic')->first();

        //        dd($academic);
        return Inertia::render('Dashboard', ['personality_data' => $personality, 'academic_data' => $academic, 'user_courses' => $user_courses]);
    }

    public function profile()
    {
        $tags = Tag::all();

        $userTag = Auth::user()->getTag();
        $user = User::with(['enrollments', 'enrollments.course', 'profile'])->find(Auth::id());
        $user_days_available = unserialize($user->profile->days_available);
//        dd($user->enrollments->last()->course->name);
        return Inertia::render('Profile', ['tags' => $tags, 'user_tag' => $userTag, 'user_data' => $user, 'user_days_available' => $user_days_available]);
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
        $user_courses = Auth::user()->with(['enrollments', 'enrollments.course'])->first();
        return Inertia::render('MyCourses', ['user_courses' => $user_courses]);
    }

    public function lesson($id)
    {
        $lesson = Layer::withoutGlobalScope(LayerScope::class)->with('videos')->find($id);
//
//        dd($lesson);
        return Inertia::render('Course', ['lesson' => $lesson]);
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

    public function results()
    {
        return Inertia::render('DiagnosticResults');
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
        return $response = Http::withHeaders(['token' => 123])->get('http://learning.ajroniwebs.com/api/courses');
    }

    public function changeTag(Request $request)
    {
        $tag = $request->keys()[0];
        switch ($tag) {
            case 'Medium':
                Auth::user()->setMedium();
                break;
            case 'Hard':
                Auth::user()->setHard();
                break;
            default:
                Auth::user()->setEasy();
        }
        return redirect()->back()->with('message', 'Post Created Successfully.');
    }
}
