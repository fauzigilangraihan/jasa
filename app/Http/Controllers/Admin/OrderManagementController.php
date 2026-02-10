<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderFile;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderManagementController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('user', 'service', 'pricingPackage')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $payments = $order->payments()->orderBy('created_at', 'desc')->get();
        $files = $order->files()->get();

        return view('admin.orders.show', compact('order', 'payments', 'files'));
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,revision,completed',
            'admin_notes' => 'nullable|string',
        ]);

        $oldStatus = $order->status;

        $order->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated_order_status',
            'model_type' => Order::class,
            'model_id' => $order->id,
            'description' => "Order status changed from {$oldStatus} to {$validated['status']}",
            'changes' => [
                'old_status' => $oldStatus,
                'new_status' => $validated['status'],
            ],
        ]);

        // Send notification to client
        // EmailService::sendOrderStatusUpdate($order);

        return back()->with('success', 'Order status updated successfully');
    }

    public function uploadResult(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'files.*' => 'required|file|max:20480', // 20MB max per file
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('orders/' . $order->id . '/results', 'public');
                OrderFile::create([
                    'order_id' => $order->id,
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_type' => 'result',
                ]);
            }

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'uploaded_project_results',
                'model_type' => Order::class,
                'model_id' => $order->id,
                'description' => 'Project results uploaded',
            ]);
        }

        return back()->with('success', 'Project results uploaded successfully');
    }
}
