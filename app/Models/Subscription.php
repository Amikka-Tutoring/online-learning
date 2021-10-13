<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends \Laravel\Cashier\Subscription
{
    use HasFactory;

    public function course()
    {
        return $this->belongsTo(Course::class, 'stripe_price', 'plan_id');
    }

}
