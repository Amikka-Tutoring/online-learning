<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiMiddleware
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
        $tokenValid = '123' == $request->header('token');
        if ( !$tokenValid ) {
            return response()->json('Unauthorized', 401);
        }

        return $next($request);
    }
}
