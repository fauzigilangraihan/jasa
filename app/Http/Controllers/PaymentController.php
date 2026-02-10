<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PaymentController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        // Middleware is registered in kernel
    }

    public function createDownPayment(Order $order)
    {
        if (!Auth::check() || Auth::id() !== $order->user_id) {
            return back()->with('error', 'Unauthorized');
        }

        if ($order->down_payment && !$order->payments()->where('type', 'down_payment')->where('status', 'confirmed')->exists()) {
            return view('payments.create', compact('order'));
        }

        return back()->with('error', 'Invalid payment request');
    }

    public function createFullPayment(Order $order)
    {
        if (!Auth::check() || Auth::id() !== $order->user_id) {
            return back()->with('error', 'Unauthorized');
        }

        $downPaymentConfirmed = $order->payments()
            ->where('type', 'down_payment')
            ->where('status', 'confirmed')
            ->exists();

        if (!$downPaymentConfirmed) {
            return back()->with('error', 'Down payment must be confirmed first');
        }

        return view('payments.create-full', compact('order'));
    }

    public function store(Request $request): RedirectResponse
    {
        $order = Order::findOrFail($request->order_id);

        if (!Auth::check() || Auth::id() !== $order->user_id) {
            return back()->with('error', 'Unauthorized');
        }

        $validated = $request->validate([
            'type' => 'required|in:down_payment,full_payment',
            'payment_method' => 'required|string|max:50',
            'payment_proof' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'notes' => 'nullable|string',
        ]);

        $amount = $validated['type'] === 'down_payment'
            ? $order->down_payment
            : ($order->total_price - ($order->down_payment ?? 0));

        $payment = Payment::create([
            'order_id' => $order->id,
            'type' => $validated['type'],
            'amount' => $amount,
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payments', 'public');
            $payment->update(['payment_proof_path' => $path]);
        }

        return redirect()->route('payments.pending', $payment)
            ->with('success', 'Payment submitted for verification');
    }

    public function pending(Payment $payment): View
    {
        if (!Auth::check() || Auth::id() !== $payment->order->user_id) {
            abort(403);
        }

        return view('payments.pending', compact('payment'));
    }

    public function history(Order $order): View
    {
        if (!Auth::check() || Auth::id() !== $order->user_id) {
            abort(403);
        }
        $payments = $order->payments()->orderBy('created_at', 'desc')->paginate(15);

        return view('payments.history', compact('order', 'payments'));
    }

    public function invoice(Order $order): View
    {
        if (!Auth::check() || Auth::id() !== $order->user_id) {
            abort(403);
        }
        $invoice = $order->invoices()->first();

        return view('payments.invoice', compact('order', 'invoice'));
    }
}

