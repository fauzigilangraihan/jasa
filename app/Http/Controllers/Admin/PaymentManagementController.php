<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentManagementController extends Controller
{
    public function index(): View
    {
        $payments = Payment::with('order.user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment): View
    {
        return view('admin.payments.show', compact('payment'));
    }

    public function confirm(Request $request, Payment $payment): RedirectResponse
    {
        $payment->update([
            'status' => 'completed',
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'confirmed_payment',
            'model_type' => Payment::class,
            'model_id' => $payment->id,
            'description' => "Payment #{$payment->id} confirmed",
        ]);

        return back()->with('success', 'Payment confirmed successfully');
    }

    public function approve(Request $request, Payment $payment): RedirectResponse
    {
        $validated = $request->validate([
            'transaction_id' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        $payment->update([
            'status' => 'confirmed',
            'transaction_id' => $validated['transaction_id'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        // Check if all payments are confirmed
        $order = $payment->order;
        if ($payment->type === 'full_payment' ||
            ($payment->type === 'down_payment' && $order->payments()->where('type', 'full_payment')->where('status', 'confirmed')->exists())) {
            $order->update(['payment_verified' => true]);

            if ($order->status === 'pending') {
                $order->update(['status' => 'in_progress']);
            }
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'approved_payment',
            'model_type' => Payment::class,
            'model_id' => $payment->id,
            'description' => "Payment {$payment->payment_number} approved",
        ]);

        return back()->with('success', 'Payment approved successfully');
    }

    public function reject(Request $request, Payment $payment): RedirectResponse
    {
        $validated = $request->validate([
            'reason' => 'required|string',
        ]);

        $payment->update([
            'status' => 'failed',
            'notes' => $validated['reason'],
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'rejected_payment',
            'model_type' => Payment::class,
            'model_id' => $payment->id,
            'description' => "Payment {$payment->payment_number} rejected",
        ]);

        return back()->with('success', 'Payment rejected');
    }

    public function generateInvoice(Request $request, Payment $payment)
    {
        $order = $payment->order;

        $invoice = Invoice::firstOrCreate([
            'order_id' => $order->id,
        ], [
            'subtotal' => $payment->amount,
            'tax' => 0,
            'total' => $payment->amount,
            'status' => 'issued',
            'issued_at' => now(),
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'generated_invoice',
            'model_type' => Invoice::class,
            'model_id' => $invoice->id,
            'description' => "Invoice {$invoice->invoice_number} generated",
        ]);

        return view('admin.payments.invoice', compact('invoice', 'order'));
    }
}
