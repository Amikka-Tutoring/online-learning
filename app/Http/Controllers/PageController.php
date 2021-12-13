<?php

namespace App\Http\Controllers;

use App\Mail\OneOnOne;
use App\Mail\ReminderMail;
use App\Models\Course;
use App\Models\Diagnostic;
use App\Models\DiagnosticQuiz;
use App\Models\Layer;
use App\Models\LayerQuizResult;
use App\Models\Note;
use App\Models\PracticeExam;
use App\Models\Subscription;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserVideoToReview;
use App\Models\Video;
use App\Models\VideoResponse;
use App\Scopes\LayerScope;
use App\Scopes\VideoScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use phpDocumentor\Reflection\Types\Boolean;
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

    public function checkRoutes()
    {
        if (auth()->user()->is_tutor()) {
            return redirect()->route('student.questions');
        } else if (auth()->user()->is_admin()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function getTokens()
    {
        $plan = auth()->user()->subscriptions()->pluck('name');
        $questions = auth()->user()->questions()->count();
        if ($plan->contains('support+')) {
            return ['tokens' => 'Unlimited'];
        } else if ($plan->contains('support')) {
            return ['tokens' => (20 - auth()->user()->questions()->count()) * 10];
        } else {
            return ['tokens' => 0];
        }
    }

    public function dashboard()
    {
        $user_courses = Auth::user()->load(['enrollments', 'enrollments.course', 'layer_quiz_results']);
        $personality = Diagnostic::with('quizzes')->where('name', 'Personality')->first();
        $academic = Diagnostic::with('quizzes', 'quizzes.questions')->where('name', 'Academic')->first();
        $user = Auth::user();
        $has_notes = auth()->user()->notes()->count();
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
            , 'calendar_exams' => $calendar_exams, 'calendar_lessons' => $calendar_lessons, 'has_notes' => $has_notes]);

    }

    public function profile()
    {
        $tags = Tag::whereIn('name', ['Easy', 'Medium', 'Hard', 'Expert', 'All'])->get();
        $userTag = Auth::user()->getTag();
        $user = Auth::user()->load(['enrollments', 'enrollments.course', 'profile', 'lesson_dates', 'practice_exam_dates']);
        $enrollments = $user->enrollments->pluck('stripe_price');
        $available_courses = Course::whereNotIn('plan_id', $enrollments)->get();
        $plan = auth()->user()->subscriptions()->active()->whereIn('name', ['basic', 'support', 'support+'])->first()->name;
        $subscription_ends_at = auth()->user()->subscription($plan)->ends_at;
        $tokens = $this->getTokens();
//        $practice_exams = $user->practice_exam_dates->pluck('date_time'));
        return Inertia::render('Profile', ['subscription_ends_at' => $subscription_ends_at, 'tags' => $tags, 'user_tag' => $userTag, 'user_data' => $user, 'available_courses' => $available_courses, 'plan' => $plan, 'tokens' => $tokens]);
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
        $lesson_dates = $user->lesson_dates;
        $lesson_dates_busy = $user->lesson_dates->pluck('day');
//        $visited = $user->exams_visited()->where('visited', 1)->pluck('exam_id');
        $scheduled = $user->practice_exam_dates->pluck('exam_id');
        $exams = PracticeExam::whereNotIn('id', $scheduled)->get();
        return Inertia::render('Exams', ['practice_exams' => $exams, 'date_diff' => $date_diff, 'lesson_dates' => $lesson_dates, 'lesson_dates_busy' => $lesson_dates_busy]);
    }

    public function myCourses()
    {
        $user_courses = Auth::user()->load(['enrollments', 'enrollments.course']);
        return Inertia::render('MyCourses', ['user_courses' => $user_courses]);
    }

    public function lesson($video)
    {
        $user = Auth::user()->load('layer_quiz_results');
        $enrolled_courses = $user->enrollments->pluck('course.id');
        $video = Video::whereHas('layer', function ($q) use ($enrolled_courses) {
            $q->whereIn('course_id', $enrolled_courses);
        })->findOrFail($video)->load('layer', 'notes', 'layer.questions', 'responses', 'responses');
        $next_link = Video::whereHas('layer', function ($q) use ($enrolled_courses) {
            $q->whereIn('course_id', $enrolled_courses);
        })->where('id', '>', $video->id)->first();
        $prev_link = Video::whereHas('layer', function ($q) use ($enrolled_courses) {
            $q->whereIn('course_id', $enrolled_courses);
        })->where('id', '<', $video->id)->first();
        $next_videos = Video::whereHas('layer', function ($q) use ($enrolled_courses) {
            $q->whereIn('course_id', $enrolled_courses);
        })->where('id', '>', $video->id)->with('tags')->take(5)->get();
        if (!$user->subscribed($video->layer->course->slug))
            return redirect()->route('dashboard')->with('message', 'You are not subscribed to this course');
        $notes = Note::where('video_id', $video)->where('user_id', auth()->user()->id)->first();
        $tokens = $this->getTokens();

        $user_attempt = count($user->layer_quiz_results->where('layer_id', $video->layer->id));
        return Inertia::render('Course', ['video' => $video, 'tokens' => $tokens, 'notes' => $notes, 'user' => $user, 'user_attempt' => $user_attempt, 'next_link' => $next_link, 'prev_link' => $prev_link, 'next_videos' => $next_videos]);
    }

    public function lessonQuiz($id)
    {
        $user = Auth::user();
        $enrolled_courses = $user->enrollments->pluck('course.id');
        $next_video = Video::whereHas('layer', function ($q) use ($enrolled_courses) {
            $q->whereIn('course_id', $enrolled_courses);
        })->where('id', '>', request()->get('video'))->first();

        if (count($user->layer_quiz_results->where('layer_id', $id)))
            return back();
        $layer = Layer::withoutGlobalScope(LayerScope::class)->with('questions', 'questions.answers', 'content')->find($id);
        return Inertia::render('Quiz', ['layer' => $layer, 'next_video' => $next_video ? route('lesson', $next_video) : route('recommended')]);
    }

    public function recommended()
    {
        $user = Auth::user()->load('enrollments', 'enrollments.course', 'layer_quiz_results');
        $completed_layers = $user->layer_quiz_results()->get()->pluck('layer_id');

        $courses = $user->enrollments()->with(['course', 'course.layers' => function ($query) {
            $query->whereNull('layers.parent_id')->with(['children', 'children.children', 'videos' => function ($query) {
                $query->withoutGlobalScopes([VideoScope::class]);
            }, 'videos.tags', 'children.videos' => function ($query) {
                $query->withoutGlobalScopes([VideoScope::class]);
            }, 'children.videos.tags', 'children.children.videos' => function ($query) {
                $query->withoutGlobalScopes([VideoScope::class]);
            }, 'children.children.videos.tags']);
        }])->get()->pluck('course');

        $enrolled_courses = $user->enrollments->pluck('course.id');
        $watched = auth()->user()->viewed_videos->pluck('id');
        $recommended_courses = Video::whereNotIn('id', $watched)->whereNotIn('layer_id', $completed_layers)->whereHas('layer', function ($q) use ($enrolled_courses) {
            $q->whereIn('course_id', $enrolled_courses);
        })->with('tags')->orderBy('id', 'asc')->take(10)->get();
        return Inertia::render('Recommended', ['courses' => $courses, 'videos' => $recommended_courses]);
    }

    public function singleCourse($course)
    {
        $course = Course::where('slug', $course)->firstOrFail();
        $user = Auth::user()->load('enrollments', 'enrollments.course', 'layer_quiz_results');
        $completed_layers = $user->layer_quiz_results()->get()->pluck('layer_id');


        $courses = $user->enrollments()->where('stripe_price', $course->plan_id)->with(['course', 'course.layers' => function ($query) {
            $query->whereNull('layers.parent_id')->with(['children', 'children.children', 'videos' => function ($query) {
                $query->withoutGlobalScopes([VideoScope::class]);
            }, 'videos.tags', 'children.videos' => function ($query) {
                $query->withoutGlobalScopes([VideoScope::class]);
            }, 'children.videos.tags', 'children.children.videos' => function ($query) {
                $query->withoutGlobalScopes([VideoScope::class]);
            }, 'children.children.videos.tags']);
        }])->get()->pluck('course');

        $watched = auth()->user()->viewed_videos->pluck('id');

        $recommended_courses = Video::whereNotIn('id', $watched)->whereNotIn('layer_id', $completed_layers)->whereHas('layer', function ($q) use ($course, $completed_layers) {
            $q->where('course_id', $course->id);
        })->with('tags')->latest()->take(10)->get();

        return Inertia::render('Recommended', ['courses' => $courses, 'videos' => $recommended_courses]);
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
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);
        $details = [];
        $details['email'] = $request->email;
        $details['phone'] = $request->phone;
        $details['message'] = $request->message;

        try {
            Mail::to('info@amikkatutoring.com')->send(new OneOnOne($details));
        } catch (\Throwable $th) {
            return $th;
            \Log::log(1, $th);
        }
        return ['message' => 'Submitted'];
    }

    public function review()
    {
        $user = Auth::user()->load('enrollments', 'enrollments.course', 'layer_quiz_results');
        $videos = $user->videos_to_review()->with('tags')->get();
        return Inertia::render('Review', ['videos' => $videos]);
    }

    public function getNotifications()
    {
        $notification = auth()->user()->unreadNotifications->take(5);
        return $notification;
    }

    public function readNotification(Request $request)
    {
        auth()->user()->unreadNotifications()->findOrFail($request->id)->markAsRead();
        $notification = auth()->user()->unreadNotifications;
        return $notification;
    }

    public function test()
    {
//        $completed = auth()->user()->layer_quiz_results()->pluck('layer_id');
//        return Layer::whereHas('questions')->whereNotIn('id', $completed)->get();
//        return auth()->user()->subscribedToPrice(env('STRIPE_BASIC'), 'basic');

//        foreach (DiagnosticQuiz::all() as $layer) {
//            $layer->content()->create();
//        }
//        $watched = auth()->user()->viewed_videos->pluck('id');
//        $videos = Video::whereNotIn('id', $watched)->get();
//        return $videos->count();

//        $user = Auth::user()->load('profile', 'tags');
//        $tags = ['Medium', 'Auditory'];
//
//        $videos = Video::with('tags')->get();
//        $videos->each(function ($item, $key) use ($videos, $tags) {
//            if ( !($item->tags->pluck('name')->diff($tags)->isEmpty()) ) {
//                $videos->forget($key);
//            }
//        });
//        return $videos->pluck('description');
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
//                $q->where('name', 'like', ' % '.''.' % ');
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

    public function videoResponse(Video $video, VideoResponse $response)
    {
        $video = $response->load('video', 'video.layer');
        return Inertia::render('VideoResponse', ['video' => $video, 'lesson' => $video->video->layer]);
    }

    public function flagVideo(Video $video)
    {
        UserVideoToReview::updateOrCreate([
            'user_id' => auth()->user()->id,
            'video_id' => $video->id
        ], [
            'user_id' => auth()->user()->id,
            'video_id' => $video->id
        ]);
        return ['message' => 'Video added to review'];
    }
}
