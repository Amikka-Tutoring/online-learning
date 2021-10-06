<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
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
}
