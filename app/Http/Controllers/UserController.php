<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\UserLessonDate;
use App\Models\UserProfile;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\BaseStripeClient;
use function PHPUnit\Framework\throwException;

class UserController extends Controller
{
    public function index(Request $request)
    {
//      filter by name
        $users = User::with('profile')->get();
        return Inertia::render('Admin/Users/Index', ['users' => $users]);
    }

    public function show($id)
    {
        $user = User::with('profile', 'lesson_dates', 'practice_exam_dates', 'enrollments', 'enrollments.course')->find($id);
        $userTag = $user->getTag();
        return Inertia::render('Admin/Users/Show', ['user' => $user, 'user_tag' => $userTag]);
    }


    public function initialQuestionnaire(Request $request)
    {
        $request->validate([
            'first_day_time' => 'required',
            'second_day_time' => 'required',
            'desire_score' => 'required',
            'exam_date' => 'required',
            'tel' => 'required',
            'email' => 'required|email|unique:user_profile,reminder_email',
        ]);
        if ($request->plan == null) {
            return back();
        }
        $user = Auth::user();
        $plan = '';
        switch ($request->plan) {
            case 'basic':
                $plan = env('STRIPE_BASIC');
                break;
            case 'support':
                $plan = env('STRIPE_SUPPORT');
                break;
            case 'support+':
                $plan = env('STRIPE_SUPPORT_PLUS');
                break;
            default:
                $plan = env('STRIPE_BASIC');
        }
        try {
            $user->newSubscription($request->plan, $plan)->trialDays(7)->add();
            foreach ($request->courses as $id) {
                if ($id == 0) {
                    $courses = Course::where('name', 'like', 'SAT%')->get();
                    foreach ($courses as $course) {
                        $user->newSubscription($course->slug, $course->plan_id)->trialDays(7)->add();
                    }
                } else {
                    $course = Course::where('plan_id', $id)->first();
                    $user->newSubscription($course->slug, $id)->trialDays(7)->add();
                }
            }
        } catch (IncompletePayment $e) {
        }

        UserLessonDate::updateOrCreate([
            'day' => $request->days[0]
        ], [
            'day' => $request->days[0],
            'time' => $request->first_day_time,
            'user_id' => $user->id
        ]);
        UserLessonDate::updateOrCreate([
            'day' => $request->days[1]
        ], [
            'day' => $request->days[1],
            'time' => $request->second_day_time,
            'user_id' => $user->id
        ]);
        UserProfile::create([
            'desire_score' => $request->desire_score,
            'exam_date' => $request->exam_date,
            'reminder_phone' => $request->tel,
            'reminder_email' => $request->email,
            'user_id' => Auth::id(),
//            'reminder_email' => $request->email,
        ]);
//        return redirect()->route('dashboard');
    }

    public function setPaymentMethod(Request $request)
    {
        $user = Auth::user();
        $paymentMethod = $request->payment_method;
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        $user->updateDefaultPaymentMethod($paymentMethod);
        return redirect()->route('main');
    }

    public function addPaymentMethod()
    {
        return Inertia::render('Stripe/PaymentMethod', ['intent' => Auth::user()->createSetupIntent(), 'STRIPE_KEY' => env('STRIPE_KEY')]);
    }

    public function subscribeForCourse(Request $request)
    {
        $user = Auth::user();
        foreach ($request->courses as $id) {
            $course = Course::where('plan_id', $id)->first();
            $user->newSubscription($course->slug, $id)->trialDays(7)->add();
        }
        $enrollments = $user->enrollments->pluck('stripe_price');
        $available_courses = Course::whereNotIn('plan_id', $enrollments)->get();
        $user_enrollments = $user->enrollments;
        return ['available_courses' => $available_courses, 'enrollments' => $user_enrollments];
    }

    public function changeExamDate($date): array
    {
        $user = Auth::user();
        $user->profile->exam_date = $date;
        $user->profile->save();
        return ['message' => 'Exam Date has been updated!'];
    }

    public function changeScoreGoal($score): array
    {
        $user = Auth::user();
        $user->profile->desire_score = $score;
        $user->profile->save();
        return ['message' => 'Score Goal has been updated!'];
    }
}
