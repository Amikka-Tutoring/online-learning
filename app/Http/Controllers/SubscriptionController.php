<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\BaseStripeClient;
use Stripe\StripeClient;

class SubscriptionController extends Controller
{
    public function subscribe()
    {
        $user = Auth::user();
//        return view('subscribe');
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
        return view('subscribe1', ['intent' => $user->createSetupIntent()
            , 'plans' => $plans]);
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
        $paymentMethod = $request->input('payment_method');
//        dd($paymentMethod);
//        $paymentMethod = 'pm_1JeLKcF6TN9qHUPOW7AmEGe2';
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        $plan = $request->input('plan');
        try {
            $user->newSubscription('default', $plan)->trialDays(7)->create($paymentMethod);
        } catch (\Exception $e) {
            dd($e);
//            return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }
        return redirect('dashboard');
    }

    public function checkStatus()
    {
        $user = Auth::user();
        if ($user->subscription('default')->onTrial()) {
            dd('trial');
        }
        dd('not trial');
    }
}
