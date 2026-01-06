<?php

namespace App\Actions\Billing;

use App\Models\Plan;
use App\Models\User;
use Laravel\Cashier\Checkout;

class CheckoutPlan
{
    public function __invoke(User $user, Plan $plan): Checkout
    {
        return $user->newSubscription('default', $plan->stripe_plan_id)->checkout([
            'success_url' => route('dashboard'),
            'cancel_url' => route('subscribe'),
            'allow_promotion_codes' => true,
        ]);
    }
}
