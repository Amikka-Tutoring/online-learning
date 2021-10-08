<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Enrollment;
use App\Models\UserLessonDate;
use App\Models\UserProfile;
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
        foreach ($request->courses as $id) {
            Enrollment::create([
                'user_id' => Auth::id(),
                'course_id' => $id
            ]);
        }
        $user = Auth::user();
        UserLessonDate::create([
            'day' => $request->days[0],
            'time' => $request->first_day_time,
            'user_id' => $user->id
        ]);
        UserLessonDate::create([
            'day' => $request->days[1],
            'time' => $request->second_day_time,
            'user_id' => $user->id
        ]);

        UserProfile::create([
            'desire_score' => $request->desire_score,
            'days_available' => serialize($request->days),
            'exam_date' => $request->exam_date,
            'first_day_time' => $request->first_day_time,
            'second_day_time' => $request->second_day_time,
            'reminder_phone' => $request->tel,
            'reminder_email' => $request->email,
            'user_id' => Auth::id(),
//            'reminder_email' => $request->email,
        ]);
        return redirect()->route('dashboard');
//        dd($request->courses);
    }
}
