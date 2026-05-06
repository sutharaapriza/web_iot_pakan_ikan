<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\FeedingLog;
use App\Models\Setting;
use App\Models\WebNotification;
use App\Notifications\IotNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class FeedingLogController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:otomatis,manual',
            'duration' => 'required|integer|min:1|max:60',
            'status' => 'required|in:sukses,gagal',
            'executed_at' => 'required|date_format:Y-m-d H:i:s',
        ]);

        FeedingLog::create($validated);

        if ($validated['status'] === 'gagal') {
            $message = "PEMBERIAN PAKAN GAGAL!\nKolam: ".Setting::get('pond_name', 'Kolam Utama')."\nWaktu: {$validated['executed_at']}\nTipe: {$validated['type']}";

            WebNotification::create([
                'type' => 'feed_failed',
                'message' => "Pemberian pakan ({$validated['type']}) gagal pada {$validated['executed_at']}",
                'created_at' => now(),
            ]);

            if (Setting::get('telegram_chat_id')) {
                Notification::send(new Device(), new IotNotification($message));
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Log saved',
        ]);
    }
}
