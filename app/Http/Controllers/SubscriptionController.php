<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Laravel\Cashier\Subscription;
use Stripe\BaseStripeClient;
use Stripe\StripeClient;

class SubscriptionController extends Controller
{
    public function subscribe()
    {
        $user = Auth::user();
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

    public function subscribeUser(Request $request)
    {
//        dd($request->all());
        $user = Auth::user();
        $paymentMethod = $request->payment_method;
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        $plan = env('PLAN_ID');
        try {
            if ( $user->subscriptions->count() )
                $user->newSubscription('Normal - LARAVEL', $plan)->create($paymentMethod);
            else
                $user->newSubscription('Test - LARAVEL', $plan)->trialDays(7)->create($paymentMethod);
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }
        return redirect('dashboard');
    }

    public function checkStatus()
    {
        $user = Auth::user();
        if ( $user->subscribed('default') ) {
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
