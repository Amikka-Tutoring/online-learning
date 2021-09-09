<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\DiagnosticQuiz;
use Illuminate\Http\Request;
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

        $answers = $request->answer_list;

        $sum = count($answers);


        $correct = 0;
        foreach ($answers as $answer) {
            if ($answer['is_correct'] == 1) {
                $correct++;
            }
        }

        $score = $correct / $sum * 100;
//        dd($score);

//        dd($request->answer_list);

        return Inertia::render('Diagnostic/Result', ['results' => $request->answer_list, 'score' => $score]);
    }
}
