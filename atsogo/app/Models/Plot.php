<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plot extends Model
{
    /** @use HasFactory<\Database\Factories\PlotFactory> */
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
    protected $attributes = [
        'status' => 'available',
        'is_new_listing' => true,
    ];
}
