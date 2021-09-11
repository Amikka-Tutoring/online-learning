<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Admin/Dashboard');
    }

    public function users()
    {
        return Inertia::render('Admin/Users/Index');
    }

    public function showUser(Request $request)
    {
//        dd($request->all());
        return Inertia::render('Admin/Users/Show', ['user' => $request->all()]);
    }

    public function courses()
    {
        $courses = Course::all();
        return Inertia::render('Admin/Courses/Index', ['courses' => $courses]);
    }

    public function academicDiagnostics()
    {
        return Inertia::render('Admin/Diagnostics/Academic/Index');
    }

    public function createAcademicDiagnostics()
    {
        return Inertia::render('Admin/Diagnostics/Academic/Create');
    }

    public function personalityDiagnostics()
    {
        return Inertia::render('Admin/Diagnostics/Personality/Index');
    }

    public function createPersonalityDiagnostics()
    {
        return Inertia::render('Admin/Diagnostics/Personality/Create');
    }

    public function createExam()
    {
        return Inertia::render('Admin/Exams/Create');
    }

    public function createCourse()
    {
        return Inertia::render('Admin/Courses/Create');
    }
}
