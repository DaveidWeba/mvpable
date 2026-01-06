<?php

namespace App\Http\Controllers;

use App\Actions\Billing\CheckoutPlan;
use App\Actions\Billing\GetSubscriptionSummary;
use App\Actions\Billing\RedirectToBillingPortal;
use App\Actions\Billing\SwapPlan;
use App\Domains\Billing\PlanCatalog;
use Exception;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(Request $request, PlanCatalog $catalog, GetSubscriptionSummary $summary)
    {
        $plans = $catalog->all();
        $data = $summary($request->user());

        return view('subscriptions.index', [
            'plans' => $plans,
            ...$data,
        ]);
    }

    public function checkout(Request $request, PlanCatalog $catalog, CheckoutPlan $checkoutPlan)
    {
        $plan = $catalog->findOrFail($request->plan);
        $checkoutSession = $checkoutPlan($request->user(), $plan);

        return redirect($checkoutSession->url);
    }

    public function swap(Request $request, PlanCatalog $catalog, SwapPlan $swapPlan)
    {
        $plan = $catalog->findOrFail($request->plan);
        $user = $request->user();

        if ($user->subscribed('default')) {
            try {
                $swapPlan($user, $plan);

                return redirect()->route('subscribe')->with('success', 'Your subscription has been updated to '.$plan->name.'.');
            } catch (Exception $e) {
                return redirect()->route('subscribe')->with('error', 'There was an error updating your subscription: '.$e->getMessage());
            }
        }

        return redirect()->route('subscribe')->with('error', 'You don\'t have an active subscription.');
    }

    public function redirectToBillingPortal(Request $request, RedirectToBillingPortal $billingPortal)
    {
        return $billingPortal($request->user());
    }
}
