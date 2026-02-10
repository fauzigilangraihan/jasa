<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PricingPackage extends Model
{
    protected $fillable = [
        'service_id',
        'name',
        'description',
        'price',
        'features',
        'delivery_days',
        'revision_rounds',
        'is_active',
    ];

    protected $casts = [
        'features' => 'json',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
