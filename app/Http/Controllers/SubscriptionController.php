<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function subscribe()
    {
        $user = Auth::user();
//        return view('subscribe');
        return view('subscribe1', ['intent' => $user->createSetupIntent()
        ]);
    }
}
