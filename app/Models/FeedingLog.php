<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedingLog extends Model
{
    protected $fillable = ['type', 'duration', 'status', 'executed_at'];

    protected $casts = [
        'executed_at' => 'datetime',
    ];
}
