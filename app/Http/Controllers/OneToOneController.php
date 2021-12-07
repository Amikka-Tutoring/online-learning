<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OneToOneController extends Controller
{
    public function pay(Request $request)
    {
        $price = '';
        switch ($request->plan) {
            case 10:
                $price = 75;
                break;
            case 20:
                $price = 70;
                break;
            case 30:
                $price = 65;
                break;
        }
        $percentace = 1;
        if ($request->payment_method === '1')
            $percentace = 0.9;
        try {
            auth()->user()->charge(($price * 100 / $request->payment_method * $request->plan) * $percentace, auth()->user()->defaultPaymentMethod()->id, ['description' => $request->payment_method_text . ' of ' . $request->plan . ' Hours - ' . auth()->user()->name]);
        } catch (\Exception $e) {
            return ['error' => 'Oops something went wrong'];
        }
        return ['message' => 'Payment Successful'];
    }
}
