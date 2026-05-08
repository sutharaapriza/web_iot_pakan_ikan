<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\FeedingSchedule;
use App\Models\FeedingLog;
use App\Models\StockLog;
use App\Models\WebNotification;
use App\Models\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', $this->getDashboardData());
    }

    public function apiData()
    {
        return response()->json($this->getDashboardData());
    }

    private function getDashboardData()
    {
        $device = Device::first();
        $latestStock = StockLog::latest('created_at')->first();
        $lastLogs = FeedingLog::latest('executed_at')->take(5)->get();
        
        $isOnline = $device && $device->last_heartbeat && $device->last_heartbeat->diffInSeconds(now()) < 120;
        
        return [
            'device' => [
                'name' => Setting::get('pond_name', 'Kolam Utama'),
                'status' => $isOnline ? 'online' : 'offline',
                'last_heartbeat' => $device && $device->last_heartbeat ? $device->last_heartbeat->translatedFormat('d M Y, H:i') : '-',
            ],
            'stock' => [
                'percentage' => $latestStock?->percentage ?? 0,
                'distance' => $latestStock?->distance ?? 0,
            ],
            'today_count' => FeedingLog::whereDate('executed_at', Carbon::today())->count(),
            'last_logs' => $lastLogs->map(function($log) {
                return [
                    'executed_at' => Carbon::parse($log->executed_at)->format('H:i'),
                    'type' => ucfirst($log->type),
                    'status' => $log->status,
                ];
            }),
            'notifications' => WebNotification::latest('created_at')->take(5)->get()->map(function($n) {
                return [
                    'message' => $n->message,
                    'created_at' => Carbon::parse($n->created_at)->diffForHumans(),
                    'is_read' => $n->is_read,
                ];
            }),
        ];
    }
}
