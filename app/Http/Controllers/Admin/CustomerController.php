<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = User::where('role', 'client')
            ->withCount('orders')
            ->withSum('orders', 'total_price')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer): View
    {
        if ($customer->role !== 'client') {
            abort(403, 'Unauthorized');
        }

        $orders = $customer->orders()->with('service', 'payments')->orderBy('created_at', 'desc')->paginate(10);
        $payments = Payment::whereHas('order', function ($query) use ($customer) {
            $query->where('user_id', $customer->id);
        })->orderBy('created_at', 'desc')->paginate(10);

        $totalSpending = $customer->orders()->sum('total_price');
        $totalOrders = $customer->orders()->count();
        $completedOrders = $customer->orders()->where('status', 'completed')->count();
        $pendingOrders = $customer->orders()->where('status', 'pending')->count();

        return view('admin.customers.show', compact(
            'customer',
            'orders',
            'payments',
            'totalSpending',
            'totalOrders',
            'completedOrders',
            'pendingOrders'
        ));
    }
}
