<?php

namespace App\Http\Controllers;

use App\Mail\OneOnOne;
use App\Mail\ReminderMail;
use App\Models\Course;
use App\Models\Diagnostic;
use App\Models\Layer;
use App\Models\LayerQuizResult;
use App\Models\PracticeExam;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use App\Scopes\LayerScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Vimeo\Vimeo;

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
        $courses = Course::where('name', 'not like', 'SAT%')->get();
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
        $user = Auth::user();
        $user_profile = $user->profile;
        $tutor_match_done = false;
        $learning_style_done = false;
        if ($user_profile->tutor_match)
            $tutor_match_done = true;
        if ($user_profile->learning_style)
            $learning_style_done = true;
        $userTag = Auth::user()->getTag();

        $date_now = Carbon::now();
        $next_practice_exam = $user->practice_exam_dates->where('date_time', '>', $date_now)->first()->date_time ?? null;

        $lesson_days = [];
        $date_now = Carbon::now()->dayOfWeek;
        foreach ($user->lesson_dates as $day) {
            array_push($lesson_days, ['day' => date('N', strtotime($day->day)), 'time' => $day->time]);
        }
        $next = 0;
        foreach ($lesson_days as $d) {
            if ($d['day'] > $date_now)
                $next = $d;
            else
                $next = min($lesson_days);
        }
        $days = [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday'
        ];
        $next_lesson_day = '';
        $next_lesson_time = '';
        $next_lesson = '';
        if ($next != 0) {
            $next_lesson_day = $days[$next['day']];
            $next_lesson_time = $next['time'];

            $next_lesson = Carbon::parse('next ' . $next_lesson_day)->format('d/m');
        }


        $calendar_exams = $user->practice_exam_dates->map(function ($item, $index) {
            return [
                'start' => Carbon::parse($item['date_time'])->toDateString()
            ];
        });
        $calendar_lessons = $user->lesson_dates->map(function ($item, $index) {
            return [
                'startTime' => $item['time'],
                'daysOfWeek' => date('N', strtotime($item['day'])),
            ];
        });
        return Inertia::render('Dashboard', ['personality_data' => $personality, 'academic_data' => $academic, 'next_practice_exam' => $next_practice_exam,
            'user_courses' => $user_courses, 'profile' => $user_profile,
            'next_lesson' => $next_lesson, 'next_lesson_day' => $next_lesson_day, 'next_lesson_time' => $next_lesson_time, 'tutor_match_done' => $tutor_match_done, 'learning_style_done' => $learning_style_done, 'user_tag' => $userTag
            , 'calendar_exams' => $calendar_exams, 'calendar_lessons' => $calendar_lessons]);
    }

    public function profile()
    {
        $tags = Tag::whereIn('name', ['Easy', 'Medium', 'Hard', 'Expert', 'All'])->get();
        $userTag = Auth::user()->getTag();
        $user = Auth::user()->load(['enrollments', 'enrollments.course', 'profile', 'lesson_dates', 'practice_exam_dates']);
        $enrollments = $user->enrollments->pluck('stripe_price');
        $available_courses = Course::whereNotIn('plan_id', $enrollments)->get();
//        $practice_exams = $user->practice_exam_dates->pluck('date_time'));
        return Inertia::render('Profile', ['tags' => $tags, 'user_tag' => $userTag, 'user_data' => $user, 'available_courses' => $available_courses]);
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
        $date = Carbon::parse($user->profile->exam_date);
        $date_diff = $date->diffForHumans();
//        $visited = $user->exams_visited()->where('visited', 1)->pluck('exam_id');
        $scheduled = $user->practice_exam_dates->pluck('exam_id');
        $exams = PracticeExam::whereNotIn('id', $scheduled)->get();
        return Inertia::render('Exams', ['practice_exams' => $exams, 'date_diff' => $date_diff]);
    }

    public function myCourses()
    {
        $user_courses = Auth::user()->load(['enrollments', 'enrollments.course']);
        return Inertia::render('MyCourses', ['user_courses' => $user_courses]);
    }

    public function lesson($video)
    {
        $video = Video::findOrFail($video)->load('layer', 'notes', 'layer.questions', 'responses', 'responses');
        $next_link = $video->layer->videos->where('id', '>', $video->id)->first();
        $prev_link = $video->layer->videos->where('id', '<', $video->id)->first();
        $next_videos = $video->layer->videos()->where('id', '>', $video->id)->with('tags')->take(3)->get();
        $user = Auth::user()->load('layer_quiz_results');
        if (!$user->subscribed($video->layer->course->slug))
            return redirect()->route('dashboard')->with('message', 'You are not subscribed to this course');
        $notes = $video->notes->first();

        $user_attempt = count($user->layer_quiz_results->where('layer_id', $video->layer->id));
        return Inertia::render('Course', ['video' => $video, 'notes' => $notes, 'user' => $user, 'user_attempt' => $user_attempt, 'next_link' => $next_link, 'prev_link' => $prev_link, 'next_videos' => $next_videos]);
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
            $query->whereNull('layers.parent_id')->with(['children', 'children.children', 'videos', 'videos.tags', 'children.videos', 'children.videos.tags', 'children.children.videos', 'children.children.videos.tags']);
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
        $date = Carbon::parse($user->profile->exam_date);
        $date_diff = $date->diffForHumans();

        $lesson_dates = $user->lesson_dates;
        $lesson_dates_busy = $user->lesson_dates->pluck('day');
//        $visited = $user->exams_visited()->where('visited', 1)->pluck('exam_id');
        $scheduled = $user->practice_exam_dates->pluck('exam_id');
        $exams = PracticeExam::whereNotIn('id', $scheduled)->get();

        $calendar_exams = $user->practice_exam_dates->map(function ($item, $index) {
            return [
                'start' => Carbon::parse($item['date_time'])->toDateString()
            ];
        });
        $calendar_lessons = $user->lesson_dates->map(function ($item, $index) {
            return [
                'startTime' => $item['time'],
                'daysOfWeek' => date('N', strtotime($item['day'])),
            ];
        });
        return Inertia::render('SetCalendar', ['date_diff' => $date_diff, 'practice_exams' => $exams, 'lesson_dates' => $lesson_dates, 'lesson_dates_busy' => $lesson_dates_busy, 'calendar_lessons' => $calendar_lessons, 'calendar_exams' => $calendar_exams]);
    }

    public function notesBlock()
    {
        return Inertia::render('NotesBlock');
    }

    public function oneToOne()
    {
        return Inertia::render('OneToOne');
    }

    public function oneToOneSubmit(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'discussion' => 'required',
            'availability' => 'required',
        ]);
        $details = [];
        $details['phone'] = $request->phone;
        $details['discuss'] = $request->discussion;
        $details['availability'] = $request->availability;

        try {
            Mail::to('Info@amikkatutoring.com')->send(new OneOnOne($details));
        } catch (\Throwable $th) {
            return $th;
            \Log::log(1, $th);
        }
        return ['message' => 'Submitted'];
    }

    public function review()
    {
        $user = Auth::user()->load('enrollments', 'enrollments.course', 'layer_quiz_results');
        $completed_layers = $user->layer_quiz_results()->where('score', ' < ', '50')->get()->pluck('layer_id');
        $courses_to_review = $user->enrollments()->with(['course', 'course.layers' => function ($query) use ($completed_layers) {
            $query->whereIn('id', $completed_layers)->with('videos', 'videos.tags');
        }])->get()->pluck('course');
        return Inertia::render('Review', ['courses_to_review' => $courses_to_review]);
    }

    public function test()
    {
//        return Video::getFiltered();
        return Video::all()->pluck('description');

        $user = Auth::user()->load('profile', 'tags');
        $tags = ['Medium', 'Auditory'];

        $videos = Video::with('tags')->get();
        $videos->each(function ($item, $key) use ($videos, $tags) {
            if (!($item->tags->pluck('name')->diff($tags)->isEmpty())) {
                $videos->forget($key);
            }
        });
        return $videos->pluck('description');
//        return Video::with('tags')->whereHas('tags', function ($query) use ($tags) {
//            $query->whereIn('name', $tags);
//        })->get();
////        dd($video, $tags, !array_diff($tags, $video));
//        $user = Auth::user();

//        dd($user->tags);
//        return Video::withoutGlobalScopes()->with('tags')->get();


//
//        $tag = Tag::where('name', 'Auditory')->first();
//        $user->tags()->detach($tag);
////        $tag = Tag::where('name', 'Easy')->first();
//        $user->tags()->attach($tag);
//        dd($user->tags);
//
//        return Video::with('tags')->get();
//
//        $notes = $user->notes()->latest()->with(['lesson', 'lesson.course', 'lesson.tags'])->whereHas('lesson', function ($query) {
//            $query->whereHas('course', function ($q) {
//                $q->where('name', 'like', ' % ' . '' . ' % ');
//            });
//        })->paginate(12)->groupBy(function ($val) {
//            return Carbon::parse($val->created_at)->format('m / d');
//        });
//        return ['notes' => $notes];
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
