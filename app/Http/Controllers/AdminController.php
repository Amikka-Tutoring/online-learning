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
        $students = User::where('role_id', 1)->get()->count();
        $tutors = User::where('role_id', 2)->get()->count();
        $admins = User::where('role_id', 3)->get()->count();
        return Inertia::render('Admin/Dashboard', ['students' => $students, 'tutors' => $tutors, 'admins' => $admins]);
    }


    public function courses()
    {
        $courses = Course::all();
        return Inertia::render('Admin/Courses/Index', ['courses' => $courses]);
    }

    public function diagnostics($slug)
    {
        $quizzes = Diagnostic::where('slug', $slug)->firstOrFail()->quizzes()->with('diagnostic')->get();
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


    public function createCourse()
    {
        return Inertia::render('Admin/Courses/Create');
    }

    public function math()
    {
        return Inertia::render('Admin/MathFormula');
    }
}
