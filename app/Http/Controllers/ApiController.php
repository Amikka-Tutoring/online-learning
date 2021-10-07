<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\PracticeExam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function courses()
    {
        $courses = User::get();
        return response()->json($courses)->header('token', '123');
    }

    public function course($slug)
    {
        $course = Course::where('slug', $slug)->first();
        if ($course) {
            return response()->json($course)->header('token', '123');
        }
        return response()->json('Course not found');
    }

    public function changeFirstDayTime($first)
    {
        $user = Auth::user();
        $user->profile->first_day_time = $first;
        $user->profile->save();
        return ['message' => 'Updated Successfully'];
    }

    public function changeSecondDayTime($second)
    {
        $user = Auth::user();
        $user->profile->second_day_time = $second;
        $user->profile->save();
        return ['message' => 'Updated Successfully'];
    }

    public function updateSchedule(Request $request)
    {
        $request->validate([
            'first_day' => 'required',
            'second_day' => 'required',
            'first_day_time' => 'required',
            'second_day_time' => 'required',
        ]);
        $user = Auth::user();
        $user->profile->days_available = serialize([$request->first_day, $request->second_day]);
        $user->profile->first_day_time = $request->first_day_time;
        $user->profile->second_day_time = $request->second_day_time;
        $user->profile->save();

        return ['message' => 'Schedule Updated Successfully'];
    }

    public function getPracticeExams()
    {
        return PracticeExam::all();
    }
}
