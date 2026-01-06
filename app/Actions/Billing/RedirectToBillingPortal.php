<?php

namespace App\Actions\Billing;

use App\Models\User;
use Illuminate\Http\RedirectResponse;

class RedirectToBillingPortal
{
    public function __invoke(User $user): RedirectResponse
    {
        return $user->redirectToBillingPortal(route('dashboard'));
    }
}
