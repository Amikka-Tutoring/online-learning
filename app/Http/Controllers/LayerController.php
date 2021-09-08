<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Diagnostic;
use App\Models\Layer;
use App\Models\Question;
use Illuminate\Http\Request;

class LayerController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        foreach ($courses as $course) {
            print_r('----------------------------------<br>');
            print_r('Course: ' . $course->name . '<br>');
            foreach ($course->topLayer() as $layer) {
                print_r('-Toplayer: ' . $layer->name . '<br>');
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
    }

    public function testLayers()
    {
        $courses = Course::all();
        foreach ($courses as $course) {
            print_r('Course: ' . $course->name . '<br>');
            foreach ($course->topLayers() as $topLayer) {
                print_r('-Toplayer: ' . $topLayer->name . '<br>');
                print_r('--Questions: <br>');
                foreach ($topLayer->questions as $t_q) {
                    print_r('---' . $t_q->title . '<br>');
                    foreach ($t_q->answers as $answer) {
                        print_r('---------' . $answer->title . '<br>');
                    }
                }
                print_r('----Videos: <br>');
                foreach ($topLayer->videos as $t_v) {
                    print_r('-------' . $t_v->title . '<br>');
                    print_r('-------' . $t_v->url . '<br>');
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
