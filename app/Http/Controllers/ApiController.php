<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function courses()
    {

        $courses = Course::all();
        return response()->json($courses->pluck('name'))->header('token', '123');
    }

    public function testCourses()
    {
        $response = Http::withHeaders(['token' => '123'])->get('localhost:8080/api/courses');
    }
}
