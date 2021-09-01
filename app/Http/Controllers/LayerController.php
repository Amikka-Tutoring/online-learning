<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\Layer;
use App\Models\Question;
use Illuminate\Http\Request;

class LayerController extends Controller
{
    public function index()
    {
        $topLayers = Layer::where('parent_id', null)->get();
        foreach ($topLayers as $layer) {
            print_r('Toplayer: ' . $layer->name . '<br>');
            print_r('--Toplayer Questions:' . '<br>');
            foreach ($layer->questions as $layer_q) {
                print_r('----' . $layer_q->question . '<br>');
            }
            foreach ($layer->children as $mid) {
                print_r('--Midlayer: ' . $mid->name . '<br>');
                foreach ($mid->questions as $mid_q) {
                    print_r('---' . $mid_q->question . '<br>');
                }
                foreach ($mid->children as $lesson) {
                    print_r('-----Lesson: ' . $lesson->name . '<br>');
                    foreach ($lesson->questions as $lesson_q) {
                        print_r('--------' . $lesson_q->question . '<br>');
                    }
                }
            }
        }
    }

    public function diagnostics()
    {
        $diagnostics = Diagnostic::all();

        foreach ($diagnostics as $diagnostic) {
            print_r('<strong>' . $diagnostic->name . ':</strong><br>');
            foreach ($diagnostic->questions as $question) {
                print_r(' - ' . $question->question . '<br>');
            }
        }

//        $diagnostic = Diagnostic::find(1);
//
//        $question = new Question;
//        $question->question = "Test";
//        $diagnostic->questions()->save($question);
//        dd($diagnostics->first()->questions);
    }
}
