<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeedingSchedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __invoke()
    {
        $schedules = FeedingSchedule::where('is_active', true)
            ->get(['time', 'duration']);

        return response()->json([
            'success' => true,
            'schedules' => $schedules
        ]);
    }
}
