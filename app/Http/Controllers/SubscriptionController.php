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
        $user = Auth::user();
//        $paymentMethod = $request->input('payment_method');
        $paymentMethod = 'pm_1JeKmqJdnIRrLjNvsZp7WBVT';
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        $plan = $request->input('plan');
        try {
            $user->newSubscription('default', $plan)->create($paymentMethod, $user);
        } catch (\Exception $e) {
            dd($e);
//            return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }
        return redirect('dashboard');
    }
}
