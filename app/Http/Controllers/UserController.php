<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request)
    {
//      filter by name
        return Inertia::render('Admin/Users/Index', [
            'users' => User::when($request->name, function ($query, $name) {
                $query->where('name', 'LIKE', '%' . $name . '%');
            })->paginate()
        ]);
    }

    public function show($id)
    {
//        dd($id);
        $user = User::find($id);
        return Inertia::render('Admin/Users/Show', ['user' => $user]);
    }
}
