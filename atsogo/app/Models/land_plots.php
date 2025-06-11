<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
 

class land_plots extends Model
{
    /** @use HasFactory<\Database\Factories\LandPlotsFactory> */
    use HasFactory;

protected $fillable = [
    'title',
    'description',
    'price',
    'area_sqm',
    'location',
    'status',
    'is_new_listing',
];

protected $casts = [
        'price' => 'decimal:2',
        'area_sqm' => 'decimal:2',
        'is_new_listing' => 'boolean',
    ];

    // Automatically update is_new_listing based on created_at
    public function getIsNewListingAttribute($value)
    {
        return $this->created_at->gt(Carbon::now()->subDays(30));
    }

    // Scopes for filtering by status
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeSold($query)
    {
        return $query->where('status', 'sold');
    }

    public function scopeNewListings($query)
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays(30));
    }

    // Status badge color helper
    public function getStatusBadgeColorAttribute()
    {
        return match($this->status) {
            'available' => 'success',
            'pending' => 'warning',
            'sold' => 'danger',
            default => 'secondary'
        };
    }
}

