<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function test(){
        return Inertia::render('Test');
    }

    public function test2(){
        return Inertia::render('Test2');
    }

    public function initialQuestionnaire(){
        return Inertia::render('InitialQuestionnaire');
    }
}
