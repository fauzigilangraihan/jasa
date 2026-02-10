<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Payment;

class PaymentPolicy
{
    public function view(User $user, Payment $payment): bool
    {
        return $user->id === $payment->order->user_id || $user->isAdmin();
    }

    public function approve(User $user, Payment $payment): bool
    {
        return $user->isAdmin();
    }

    public function reject(User $user, Payment $payment): bool
    {
        return $user->isAdmin();
    }
}
