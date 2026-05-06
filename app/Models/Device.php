<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['name', 'last_heartbeat', 'status', 'manual_feed_pending'];

    protected $casts = [
        'last_heartbeat' => 'datetime',
        'manual_feed_pending' => 'boolean',
    ];
}
