<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\DiagnosticQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DiagnosticController extends Controller
{
    public function show($slug)
    {
        $diagnostic = DiagnosticQuiz::where('slug', $slug)->with('questions', 'diagnostic', 'questions.answers')->first();
        return Inertia::render('Diagnostic/Index', ['diagnostic' => $diagnostic]);
    }

    public function result(Request $request)
    {
        $answers = $request->answer_list[0];
        $sum = count($answers);
        $points = 0;
        $correct = 0;
        foreach ($answers as $answer) {
            $points += $answer['explanation'];
        }
        $score = $points / $sum;
        $user = Auth::user();
        $user->profile->learning_style = $score;
        return Inertia::render('DiagnosticResults', ['results' => $answers, 'score' => $score]);
    }

    public function updateQuiz(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $quiz = DiagnosticQuiz::findOrFail($id);
        $quiz->update([
            'name' => $request->name
        ]);
        return ['message' => 'Updated Successfully'];

    }

    public function deleteQuiz($id)
    {
        DiagnosticQuiz::findOrFail($id)->delete();
        return ['message' => 'Deleted Successfully'];
    }

    public function getAcademicQuizzes()
    {
        return Diagnostic::where('name', 'Academic')->first()->quizzes;
    }

    public function getPersonalityQuizzes()
    {
        return Diagnostic::where('name', 'Personality')->first()->quizzes;
    }
}
