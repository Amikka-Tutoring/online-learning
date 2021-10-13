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
        $user = User::with('profile')->find($id);
        $userTag = $user->getTag();
        return Inertia::render('Admin/Users/Show', ['user' => $user, 'user_tag' => $userTag]);
    }


    public function initialQuestionnaire(Request $request)
    {
//        $request->validate([
//            'first_day_time' => 'required',
//            'second_day_time' => 'required',
//            'desire_score' => 'required',
//            'exam_date' => 'required',
//            'reminder_phone' => 'required',
//            'reminder_email' => 'required',
//        ]);
        $user = Auth::user();
        foreach ($request->courses as $id) {
            $user->newSubscription('default', $id)->trialDays(7)->add();
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
        return redirect()->route('dashboard');
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
            $user->newSubscription('default', $id)->trialDays(7)->add();
        }
        $enrollments = $user->enrollments->pluck('stripe_price');
        $available_courses = Course::whereNotIn('plan_id', $enrollments)->get();
        $user_enrollments = $user->enrollments;
        return ['available_courses' => $available_courses, 'enrollments' => $user_enrollments];
    }
}
