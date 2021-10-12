<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\PracticeExam;
use App\Models\User;
use Carbon\Carbon;
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
        if ( $course ) {
            return response()->json($course)->header('token', '123');
        }
        return response()->json('Course not found');
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

    public function getLessonDates()
    {
        $user = Auth::user();
        $lesson_dates = $user->lesson_dates;
        $lesson_dates_busy = $user->lesson_dates->pluck('day');
        return ['lesson_dates' => $lesson_dates, 'lesson_dates_busy' => $lesson_dates_busy];
    }

    public function getUserPracticeExams()
    {
        $user = Auth::user();
        return $user->practice_exam_dates->map(function ($item, $index) {
            return [
                'start' => Carbon::parse($item['date_time'])->toDateString()
            ];
        });

    }

    public function getUserLessonDates()
    {
        $user = Auth::user();
        return $user->lesson_dates->map(function ($item, $index) {
            return [
                'startTime' => $item['time'],
                'daysOfWeek' => date('N', strtotime($item['day'])),
            ];
        });
    }

    public function set_lesson_length($length)
    {
        if ( is_numeric($length) ) {
            $profile = Auth::user()->profile;
            $profile->lesson_length = $length;
            $profile->save();
            return ['message' => 'Lesson Length has been updated'];
        }
    }

}
