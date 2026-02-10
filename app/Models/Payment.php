<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'payment_number',
        'order_id',
        'type',
        'amount',
        'status',
        'payment_method',
        'transaction_id',
        'payment_proof_path',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($payment) {
            $payment->payment_number = 'PAY-' . date('YmdHis') . '-' . rand(1000, 9999);
        });
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
