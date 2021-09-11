<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Enrollment;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request)
    {
//      filter by name
        return Inertia::render('Admin/Users/Index', [
            'users' => User::when($request->name, function ($query, $name) {
                $query->where('name', 'LIKE', '%' . $name . '%');
            })->paginate()
        ]);
    }

    public function show($id)
    {
//        dd($id);
        $user = User::find($id);
        return Inertia::render('Admin/Users/Show', ['user' => $user]);
    }


    public function initialQuestionnaire(Request $request)
    {
        foreach ($request->courses as $id) {
            Enrollment::create([
                'user_id' => Auth::id(),
                'course_id' => $id
            ]);
        }
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
