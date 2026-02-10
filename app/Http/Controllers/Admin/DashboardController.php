<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalOrders = Order::count();
        $completedOrders = Order::where('status', 'completed')->count();
        $activeProjects = Order::whereIn('status', ['in_progress', 'revision'])->count();
        $totalRevenue = Payment::where('status', 'confirmed')->sum('amount');

        $recentOrders = Order::with('user', 'service')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $pendingPayments = Payment::where('status', 'pending')
            ->with('order.user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $totalClients = User::where('role', 'client')->count();

        return view('admin.dashboard', compact(
            'totalOrders',
            'completedOrders',
            'activeProjects',
            'totalRevenue',
            'recentOrders',
            'pendingPayments',
            'totalClients'
        ));
    }
}
