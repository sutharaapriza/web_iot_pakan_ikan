<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Setting;
use App\Models\StockLog;
use App\Models\WebNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HeartbeatController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'distance' => 'required|numeric|min:0|max:999.99',
        ]);

        $device = Device::firstOrCreate(
            [],
            ['name' => Setting::get('pond_name', 'Kolam Utama')]
        );

        $device->update([
            'last_heartbeat' => now(),
            'status' => 'online',
        ]);

        $distance = (float) $request->input('distance');
        $maxDistance = (float) Setting::get('empty_distance', 20.0);
        $minDistance = (float) Setting::get('full_distance', 5.0);

        if ($maxDistance === $minDistance) {
            $maxDistance += 0.1;
        }

        $percentage = max(0, min(100, (int) round((($maxDistance - $distance) / ($maxDistance - $minDistance)) * 100)));

        StockLog::create([
            'distance' => $distance,
            'percentage' => $percentage,
            'created_at' => now(),
        ]);

        $threshold = (float) Setting::get('low_stock_threshold', 15.0);
        if ($distance > $threshold) {
            $lastNotif = WebNotification::where('type', 'low_stock')
                ->where('created_at', '>', now()->subHour())
                ->first();

            if (! $lastNotif) {
                $message = "Stok pakan menipis!\nKolam: ".Setting::get('pond_name', 'Kolam Utama')."\nJarak sisa: {$distance} cm";

                WebNotification::create([
                    'type' => 'low_stock',
                    'message' => "Stok pakan menipis! Jarak sisa: {$distance} cm",
                    'created_at' => now(),
                ]);

                $telegramChatId = Setting::get('telegram_chat_id');
                $telegramBotToken = config('services.telegram-bot-api.token');
                
                if ($telegramChatId && $telegramBotToken) {
                    try {
                        \Illuminate\Support\Facades\Http::post(
                            "https://api.telegram.org/bot{$telegramBotToken}/sendMessage",
                            [
                                'chat_id' => $telegramChatId,
                                'text' => $message,
                            ]
                        );
                    } catch (\Exception $e) {
                        \Illuminate\Support\Facades\Log::error('Telegram notification failed: ' . $e->getMessage());
                    }
                }
            }
        }

        $manualPending = $device->manual_feed_pending;
        $servoDuration = $manualPending
            ? (int) Setting::get('manual_feed_duration', Setting::get('servo_duration', 3))
            : (int) Setting::get('servo_duration', 3);

        if ($manualPending) {
            $device->update(['manual_feed_pending' => false]);
            Setting::set('manual_feed_duration', null);
        }

        return response()->json([
            'success' => true,
            'manual_feed' => $manualPending,
            'servo_duration' => $servoDuration,
        ]);
    }
}
