<?php

namespace App\Http\Controllers;

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
}
