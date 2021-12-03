<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribedMiddleware
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
        foreach (auth()->user()->subscriptions()->get() as $subscription) {
            optional(auth()->user()->subscription($subscription->name))->syncStripeStatus();
        }
        if ($request->user() && !$request->user()->subscriptions()->active()->whereIn('name', ['basic', 'support', 'support+'])->where('stripe_status', '!=', 'canceled')->count())
            return redirect()->route('subscribe.plans');
        return $next($request);
    }
}
