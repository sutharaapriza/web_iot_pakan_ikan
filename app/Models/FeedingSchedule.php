<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedingSchedule extends Model
{
    protected $fillable = ['time', 'duration', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
