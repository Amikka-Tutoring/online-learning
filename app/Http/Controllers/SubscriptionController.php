<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Laravel\Cashier\Subscription;
use Stripe\BaseStripeClient;
use Stripe\Plan;
use Stripe\Stripe;
use Stripe\StripeClient;

class SubscriptionController extends Controller
{
    public function subscribe()
    {
        $user = Auth::user();
        if ($user->subscriptions->count())
            return redirect()->route('dashboard');
        $key = env('STRIPE_SECRET');
        $stripe = new StripeClient($key);
        $plansraw = $stripe->plans->all();
        $plans = $plansraw->data;
        foreach ($plans as $plan) {
            $prod = $stripe->products->retrieve(
                $plan->product, []
            );
            $plan->product = $prod;
        }
        return Inertia::render('Stripe/Subscribe', ['intent' => $user->createSetupIntent(), 'plans' => $plans, 'STRIPE_KEY' => env('STRIPE_KEY')]);
    }

    public function retrievePlans()
    {
        $key = env('STRIPE_SECRET');
        $stripe = new StripeClient($key);
        $plansraw = $stripe->plans->all();
        $plans = $plansraw->data;
        foreach ($plans as $plan) {
            $prod = $stripe->products->retrieve(
                $plan->product, []
            );
            $plan->product = $prod;
        }
        return $plans;
    }

    public function cancelSubscription($plan_id)
    {
        $subscription = Auth::user()->enrollments->where('stripe_price', $plan_id)->first();
        $subscription->cancel();
        return ['message' => 'Canceled! Your subscription will ends at: ' . $subscription->ends_at->format('Y-m-d')];
    }

    public function subscribeUser(Request $request)
    {
        $user = Auth::user();
        $plan = env('PLAN_ID');
        $paymentMethod = $user->defaultPaymentMethod();
        try {
            if ($user->subscriptions->count())
                $user->newSubscription('default', $plan)->create($paymentMethod);
            else
                $user->newSubscription('default', $plan)->trialDays(7)->create($paymentMethod);
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Error creating subscription . ' . $e->getMessage()]);
        }
        return redirect()->route('main');
    }

    public function subscribeUserGet()
    {
        $user = Auth::user();

//        $plan = env('PLAN_ID');


//        $user->newSubscription('default', 'plan_KOqNkHieifQD6F')->add();
        $subscriptions = $user->subscriptions->pluck('stripe_price');
        dd(Course::whereIn('plan_id', $subscriptions)->get());
    }

    function cancelAllSubscriptions()
    {
        foreach (Auth::user()->subscriptions as $subscription) {
            $subscription->cancel();
        }
    }

    public function checkStatus()
    {
        $user = Auth::user();
        if ($user->subscribed('default')) {
            dd('trial');
        }
        dd('not trial');
    }

    public function getSubscriptions()
    {
        $user = Auth::user();
        dd($user->subscriptions);
//        if ($user->)
    }
}
