<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasPaymentMethod
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
        if ( $request->user() && !$request->user()->hasPaymentMethod() )
            return redirect()->route('add.payment.method');
        return $next($request);
    }
}
