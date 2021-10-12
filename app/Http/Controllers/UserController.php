<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Enrollment;
use App\Models\UserLessonDate;
use App\Models\UserProfile;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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
        foreach ($request->courses as $id) {
            Enrollment::create([
                'user_id' => Auth::id(),
                'course_id' => $id
            ]);
        }
        $user = Auth::user();
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

}
