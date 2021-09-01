<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InitialQuestionnaire
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        dd(Auth::user()->profile);
        if (!Auth::user()->profile) {
            return redirect('initial-questionnaire');
        }
        return $next($request);
    }
}
