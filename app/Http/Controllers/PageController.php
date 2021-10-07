<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Diagnostic;
use App\Models\Layer;
use App\Models\LayerQuizResult;
use App\Models\PracticeExam;
use App\Models\Tag;
use App\Models\User;
use App\Scopes\LayerScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PageController extends Controller
{

    public function test2()
    {
        $user = Auth::user()->load('enrollments', 'enrollments.course', 'layer_quiz_results');
        $completed_layers = $user->layer_quiz_results()->where('score', '<', '50')->get()->pluck('layer_id');
        $courses = $user->enrollments()->with(['course', 'course.layers' => function ($query) use ($completed_layers) {
            $query->whereIn('id', $completed_layers);
        }])->get()->pluck('course');
        return $courses;
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
        $user_courses = Auth::user()->load(['enrollments', 'enrollments.course', 'layer_quiz_results']);
        $personality = Diagnostic::with('quizzes')->where('name', 'Personality')->first();
        $academic = Diagnostic::with('quizzes', 'quizzes.questions')->where('name', 'Academic')->first();
        $user_profile = Auth::user()->profile;
        $days_available = unserialize($user_profile->days_available);
        $first_date = Carbon::parse('next ' . $days_available[0])->format('d / m');
        $second_date = Carbon::parse('next ' . $days_available[1])->format('d / m');
        return Inertia::render('Dashboard', ['personality_data' => $personality, 'academic_data' => $academic,
            'user_courses' => $user_courses, 'profile' => $user_profile, 'days_available' => $days_available,
            'first_date' => $first_date, 'second_date' => $second_date
        ]);
    }

    public function profile()
    {
        $tags = Tag::all();
        $userTag = Auth::user()->getTag();
        $user = Auth::user()->load(['enrollments', 'enrollments.course', 'profile']);
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
        $user = Auth::user();


        $visited = $user->exams_visited()->where('visited', 1)->pluck('exam_id');
        $exams = PracticeExam::whereNotIn('id', $visited)->get();
        return Inertia::render('Exams', ['practice_exams' => $exams]);
    }

    public function myCourses()
    {
        $user_courses = Auth::user()->load(['enrollments', 'enrollments.course']);
        return Inertia::render('MyCourses', ['user_courses' => $user_courses]);
    }

    public function lesson($id)
    {
        $lesson = Layer::withoutGlobalScope(LayerScope::class)->with('videos', 'questions')->find($id);
        $user = Auth::user()->load('layer_quiz_results');
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
        $user = Auth::user()->load('enrollments', 'enrollments.course', 'layer_quiz_results');
        $completed_layers = $user->layer_quiz_results()->get()->pluck('layer_id');


        $courses = $user->enrollments()->with(['course', 'course.layers' => function ($query) {
            $query->whereNull('layers.parent_id')->with(['children', 'children.children', 'videos', 'children.videos', 'children.children.videos']);
        }])->get()->pluck('course');

        $recommended_courses = $user->enrollments()->with(['course', 'course.layers' => function ($query) use ($completed_layers) {
            $query->whereNull('layers.parent_id')->whereNotIn('layers.id', $completed_layers)->with(['videos', 'children.videos', 'children' => function ($query_children) use ($completed_layers) {
                $query_children->whereNotIn('id', $completed_layers)->with(['videos', 'children.videos', 'children' => function ($query_children_children) use ($completed_layers) {
                    $query_children_children->whereNotIn('id', $completed_layers)->with('videos');
                }]);
            }]);
        }
        ])->get()->pluck('course');
        return Inertia::render('Recommended', ['courses' => $courses, 'recommended_courses' => $recommended_courses]);
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
        $user = Auth::user();
        $days = unserialize($user->profile->days_available);
        $first_day = $days[0];
        $second_day = $days[1];
        $first_day_time = $user->profile->first_day_time;
        $second_day_time = $user->profile->second_day_time;
        return Inertia::render('SetCalendar', ['first_day' => $first_day, 'second_day' => $second_day, 'first_day_time' => $first_day_time, 'second_day_time' => $second_day_time]);
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
        $user = Auth::user()->load('enrollments', 'enrollments.course', 'layer_quiz_results');
        $completed_layers = $user->layer_quiz_results()->where('score', '<', '50')->get()->pluck('layer_id');
        $courses_to_review = $user->enrollments()->with(['course', 'course.layers' => function ($query) use ($completed_layers) {
            $query->whereIn('id', $completed_layers);
        }])->get()->pluck('course');
        return Inertia::render('Review', ['courses_to_review' => $courses_to_review]);
    }

    public function test()
    {
        $user = Auth::user();
        $notes = $user->notes()->latest()->with(['lesson', 'lesson.course', 'lesson.tags'])->whereHas('lesson', function ($query) {
            $query->whereHas('course', function ($q) {
                $q->where('name', 'like', '%' . '' . '%');
            });
        })->paginate(12)->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('m/d');
        });
        return ['notes' => $notes];
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
