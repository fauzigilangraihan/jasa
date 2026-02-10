<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'service_id',
        'pricing_package_id',
        'project_name',
        'project_description',
        'status',
        'delivery_date',
        'requirements',
        'total_price',
        'down_payment',
        'payment_verified',
        'admin_notes',
    ];

    protected $casts = [
        'requirements' => 'json',
        'total_price' => 'decimal:2',
        'down_payment' => 'decimal:2',
        'payment_verified' => 'boolean',
        'delivery_date' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            $order->order_number = 'ORD-' . date('YmdHis') . '-' . rand(1000, 9999);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function pricingPackage(): BelongsTo
    {
        return $this->belongsTo(PricingPackage::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(OrderFile::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
