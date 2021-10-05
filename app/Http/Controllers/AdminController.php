<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Diagnostic;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function PHPUnit\Framework\throwException;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        return Inertia::render('Admin/Dashboard', ['user_count' => $users->count()]);
    }


    public function courses()
    {
        $courses = Course::all();
        return Inertia::render('Admin/Courses/Index', ['courses' => $courses]);
    }

    public function diagnostics($slug)
    {
        $quizzes = Diagnostic::where('slug', $slug)->firstOrFail()->quizzes;
        $diagnostic_name = $quizzes->first()->diagnostic->name;
        return Inertia::render('Admin/Diagnostics/Index', ['quizzes' => $quizzes, 'diagnostic_name' => $diagnostic_name]);
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
