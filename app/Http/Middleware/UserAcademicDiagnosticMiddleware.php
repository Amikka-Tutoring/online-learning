<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAcademicDiagnosticMiddleware
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
        $user = \Auth::user()->load('profile');
        if ($user->profile->math_score == null || $user->profile->grammar_score == null || $user->profile->reading_score == null) {
            return redirect()->route('dashboard')->with('message', 'You need to complete all the Academic Diagnostic Tests');
        }
        return $next($request);
    }
}
