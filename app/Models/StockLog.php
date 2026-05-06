<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    protected $fillable = ['distance', 'percentage', 'created_at'];
    public $timestamps = false; // We use created_at manually

    protected $casts = [
        'distance' => 'decimal:2',
        'percentage' => 'integer',
        'created_at' => 'datetime',
    ];
}
