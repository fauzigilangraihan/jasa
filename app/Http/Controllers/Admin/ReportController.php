<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $totalRevenue = Payment::where('status', 'confirmed')->sum('amount');
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', 'client')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $conversionRate = ($totalOrders > 0 && $totalCustomers > 0) ? round(($completedOrders / $totalOrders) * 100, 2) : 0;

        return view('admin.reports.index', compact(
            'totalRevenue',
            'totalOrders',
            'totalCustomers',
            'completedOrders',
            'conversionRate'
        ));
    }

    public function sales(Request $request): View
    {
        $query = Order::with('user', 'service', 'payments');

        // Filter by date range
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(20);

        // Calculate metrics
        $totalSales = Order::where('status', 'completed')->sum('total_price');
        $averageOrderValue = $totalOrders = Order::count() > 0 ? Order::sum('total_price') / Order::count() : 0;
        $pendingAmount = Order::where('status', 'pending')->sum('total_price');

        return view('admin.reports.sales', compact(
            'orders',
            'totalSales',
            'averageOrderValue',
            'pendingAmount'
        ));
    }

    public function payments(Request $request): View
    {
        $query = Payment::with('order.user', 'order.service');

        // Filter by date range
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->orderBy('created_at', 'desc')->paginate(20);

        // Calculate metrics
        $confirmedAmount = Payment::where('status', 'confirmed')->sum('amount');
        $pendingAmount = Payment::where('status', 'pending')->sum('amount');
        $averagePayment = Payment::count() > 0 ? Payment::sum('amount') / Payment::count() : 0;

        return view('admin.reports.payments', compact(
            'payments',
            'confirmedAmount',
            'pendingAmount',
            'averagePayment'
        ));
    }
}
