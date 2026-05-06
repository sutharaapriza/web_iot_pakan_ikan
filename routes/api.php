<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HeartbeatController;
use App\Http\Controllers\Api\FeedingLogController;
use App\Http\Controllers\Api\ScheduleController;

Route::middleware('api.token')->group(function () {
    Route::post('/heartbeat', HeartbeatController::class);
    Route::post('/feeding-log', FeedingLogController::class);
    Route::get('/schedules', ScheduleController::class);
});
