<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Diagnostic;
use App\Models\Layer;
use App\Models\LayerQuizResult;
use App\Models\Tag;
use App\Models\User;
use App\Scopes\LayerScope;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class PageController extends Controller
{

    public function test2()
    {
        $quizzes_count = 0;
        $course = Course::where('name', 'Grammar')->first();
        foreach ($course->topLayers() as $topLayer) {
            if (count($topLayer->questions)) {
                $quizzes_count++;
            }
            foreach ($topLayer->children as $mid) {
                if (count($mid->questions)) {
                    $quizzes_count++;
                }
                foreach ($mid->children as $less) {
                    if (count($less->questions)) {
                        $quizzes_count++;
                    }
                }
            }
        }
        dd($quizzes_count);
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
        $user_courses = Auth::user()->with(['enrollments', 'enrollments.course', 'layer_quiz_results'])->first();
        $personality = Diagnostic::with('quizzes')->where('name', 'Personality')->first();
        $academic = Diagnostic::with('quizzes', 'quizzes.questions')->where('name', 'Academic')->first();
        $user_profile = Auth::user()->profile;
        $days_available = unserialize($user_profile->days_available);
        $first_date = Carbon::parse('next ' . $days_available[0])->format('d/m');
        $second_date = Carbon::parse('next ' . $days_available[1])->format('d/m');
        return Inertia::render('Dashboard', ['personality_data' => $personality, 'academic_data' => $academic,
            'user_courses' => $user_courses, 'profile' => $user_profile, 'days_available' => $days_available,
            'first_date' => $first_date, 'second_date' => $second_date
        ]);
    }

    public function profile()
    {
        $tags = Tag::all();
        $userTag = Auth::user()->getTag();
        $user = User::with(['enrollments', 'enrollments.course', 'profile'])->find(Auth::id());
        $user_days_available = unserialize($user->profile->days_available);
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
        $lesson = Layer::withoutGlobalScope(LayerScope::class)->with('videos', 'questions')->find($id);
        $user = Auth::user()->with('layer_quiz_results')->first();
        $user_attempt = count($user->layer_quiz_results->where('layer_id', $id));
        $notes = $user->notes->where('layer_id', $lesson->id)->first();
        return Inertia::render('Course', ['lesson' => $lesson, 'notes' => $notes, 'user' => $user, 'user_attempt' => $user_attempt]);
    }

    public function lessonQuiz($id)
    {
        $user = Auth::user();
        if (count($user->layer_quiz_results->where('layer_id', $id)))
            return back();
        $layer = Layer::withoutGlobalScope(LayerScope::class)->with('questions', 'questions.answers')->find($id);
        return Inertia::render('Quiz', ['layer' => $layer]);
    }

    public function recommended()
    {
        $user = Auth::user()->with('enrollments', 'enrollments.course')->first();
        $courses = $user->enrollments()->with(['course', 'course.layers' => function ($query) {
            $query->whereNull('layers.parent_id')->with(['children', 'children.children', 'videos', 'children.videos', 'children.children.videos']);
        }])->get()->pluck('course');
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
        $user = Auth::user();
        $notes = $user->notes()->with(['lesson', 'lesson.course', 'lesson.tags'])->get();
        return Inertia::render('NotesList', ['notes' => $notes]);
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
        $user = Auth::user();
        $quizzes_count = 0;
        foreach ($course->topLayers() as $topLayer) {
            foreach ($user->layer_quiz_results as $r) {
                if ($r->layer == $topLayer) {
                    $quizzes_count++;
                }
            }
            foreach ($topLayer->children as $mid) {
                foreach ($user->layer_quiz_results as $t) {
                    if ($t->layer == $mid) {
                        $quizzes_count++;
                    }
                }
                foreach ($mid->children as $less) {
                    foreach ($user->layer_quiz_results as $e) {
                        if ($e->layer == $less) {
                            $quizzes_count++;
                        }
                    }
                }
            }
        }
        dd($quizzes_count);
    }

    public function changeTag(Request $request)
    {
        $user = Auth::user();
        $request_tag = $request->keys()[0];
        $tag = Tag::where('name', $request_tag)->firstOrFail();
        $user->tags()->sync($tag);
        $message = 'Course level is set to: ' . $request_tag;
        return ['tag' => $request_tag, 'message' => $message];
    }
}
