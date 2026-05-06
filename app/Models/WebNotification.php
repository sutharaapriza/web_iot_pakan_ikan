<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebNotification extends Model
{
    protected $fillable = ['type', 'message', 'is_read', 'created_at'];
    public $timestamps = false;

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
    ];
}
