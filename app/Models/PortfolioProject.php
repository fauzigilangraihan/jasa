<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortfolioProject extends Model
{
    protected $fillable = [
        'title',
        'description',
        'website_url',
        'thumbnail_path',
        'service_id',
        'images',
        'industry',
        'is_active',
        'order_column',
    ];

    protected $casts = [
        'images' => 'json',
        'is_active' => 'boolean',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
