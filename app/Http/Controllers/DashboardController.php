<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Middleware registered in routes
    }

    public function index(): View
    {
        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        $payments = Payment::whereHas('order', function ($query) {
            $query->where('user_id', Auth::id());
        })->latest()->limit(5)->get();

        $totalOrders = Order::where('user_id', $user->id)->count();
        $totalSpent = Payment::whereHas('order', function ($query) {
            $query->where('user_id', Auth::id());
        })->where('status', 'completed')->sum('amount');

        return view('dashboard', compact('orders', 'payments', 'totalOrders', 'totalSpent'));
    }
}

