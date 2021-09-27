<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

class SubscriptionController extends Controller
{
    public function subscribe()
    {
        $user = Auth::user();
//        return view('subscribe');
        return view('subscribe1', ['intent' => $user->createSetupIntent()
        ]);
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

    public function subscribeUser()
    {
        $user = Auth::user();
        $user->newSubscription('default', 'price_1JZDFpF6TN9qHUPO9iO5cJkv')->create('email');
    }
}
