<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeedingLog;
use App\Models\Setting;
use App\Models\WebNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

        return response()->json([
            'success' => true,
            'message' => 'Log saved',
        ]);
    }
}
