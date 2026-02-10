<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;

class PaymentService
{
    /**
     * Create payment for order
     * Ready for Midtrans integration
     */
    public static function createPayment(Order $order, string $method = 'bank_transfer'): Payment
    {
        return Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total_amount,
            'payment_method' => $method,
            'status' => 'pending',
            'transaction_id' => 'TRX-' . time() . '-' . $order->id,
        ]);
    }

    /**
     * Confirm payment from gateway webhook
     */
    public static function confirmPayment(Payment $payment, string $transactionId): void
    {
        $payment->update([
            'status' => 'completed',
            'transaction_id' => $transactionId,
        ]);

        // Update order status
        $order = $payment->order;
        $order->update(['status' => 'in_progress']);
    }

    /**
     * Handle Midtrans webhook
     * Usage: In webhook controller
     */
    public static function handleMidtransWebhook(array $notification): void
    {
        $orderId = $notification['order_id'];
        $transactionStatus = $notification['transaction_status'];

        $payment = Payment::where('order_id', $orderId)->first();

        if ($transactionStatus === 'settlement') {
            static::confirmPayment($payment, $notification['transaction_id']);
        } elseif ($transactionStatus === 'pending') {
            $payment->update(['status' => 'pending']);
        } elseif ($transactionStatus === 'deny' || $transactionStatus === 'expire' || $transactionStatus === 'cancel') {
            $payment->update(['status' => 'failed']);
        }
    }

    /**
     * Generate Midtrans Snap Token
     * Usage: In order controller when creating payment
     */
    public static function generateSnapToken(Order $order): string
    {
        // Uncomment when Midtrans installed
        // \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        // \Midtrans\Config::$clientKey = config('services.midtrans.client_key');
        // \Midtrans\Config::$isSanitized = true;
        // \Midtrans\Config::$is3ds = true;

        // $payload = [
        //     'transaction_details' => [
        //         'order_id' => $order->id,
        //         'gross_amount' => $order->total_amount,
        //     ],
        //     'customer_details' => [
        //         'first_name' => $order->user->name,
        //         'email' => $order->user->email,
        //         'phone' => $order->user->phone,
        //     ],
        //     'item_details' => [
        //         [
        //             'id' => $order->package->service->id,
        //             'price' => $order->total_amount,
        //             'quantity' => 1,
        //             'name' => $order->package->name,
        //         ]
        //     ],
        // ];

        // return \Midtrans\Snap::getSnapToken($payload);

        return 'token_placeholder';
    }
}
