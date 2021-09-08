<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PageController extends Controller
{
    public function test()
    {
        return Inertia::render('Test');
    }

    public function test2()
    {
        return Inertia::render('Test2');
    }

    public function initialQuestionnaire()
    {
        if (Auth::user()->profile) {
            return redirect()->route('dashboard');
        }
        return Inertia::render('InitialQuestionnaire');
    }

    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }

    public function profile()
    {

//        $user = auth()->user();
        return Inertia::render('Profile');
    }

    public function mathDiagnostic()
    {
        return Inertia::render('MathDiagnostic');
    }

    public function postMathDiagnostic(Request $request)
    {
        return Inertia::render('DiagnosticResults');
    }

    public function exams()
    {
        return Inertia::render('Exams');
    }

    public function myCourses()
    {
        return Inertia::render('MyCourses');
    }

    public function recommended()
    {
        $courses = Course::with('layers')->first();
        return Inertia::render('Recommended');
    }

    public function course()
    {
        return Inertia::render('Course');
    }

    public function calendar()
    {
        return Inertia::render('Calendar');
    }

    public function setCalendar()
    {
        return Inertia::render('SetCalendar');
    }

    public function notesList()
    {
        return Inertia::render('NotesList');
    }

    public function notesBlock()
    {
        return Inertia::render('NotesBlock');
    }

    public function createNotes()
    {
        return Inertia::render('CreateNotes');
    }

    public function oneToOne()
    {
        return Inertia::render('OneToOne');
    }

    public function review()
    {
        return Inertia::render('Review');
    }
}
