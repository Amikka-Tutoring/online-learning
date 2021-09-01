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

//        dd($diagnostic);

//        dd(count($diagnostic->questions));

////        dd($diagnostic->questions);
//
//        $questions = $diagnostic->questions;
//        foreach ($questions as $q) {
//            print_r($q->question . '<br>');
//            foreach ($q->answers as $a) {
//                print_r('-' . $a->answer . '<br>');
//            }
//        }
        return Inertia::render('Diagnostic/Index', ['diagnostic' => $diagnostic]);
    }
}
