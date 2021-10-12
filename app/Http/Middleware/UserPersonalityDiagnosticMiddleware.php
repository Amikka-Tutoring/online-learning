<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserPersonalityDiagnosticMiddleware
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
        if ( $user->profile->learning_style == null || $user->profile->tutor_match == null ) {
            return redirect()->route('dashboard')->with('message', 'You need to complete Personality Diagnostic Tests');
        }
        return $next($request);
    }
}
