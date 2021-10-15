<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Stripe\Plan;
use Stripe\Stripe;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $plan = Plan::create([
            "amount" => 2000,
            "interval" => "month",
            "product" => [
                "name" => 'Amikka Platform'
            ],
            "currency" => "USD",
        ]);
    }
}
