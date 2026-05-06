<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'servo_duration' => Setting::get('servo_duration'),
            'low_stock_threshold' => Setting::get('low_stock_threshold'),
            'offline_threshold' => Setting::get('offline_threshold'),
            'telegram_chat_id' => Setting::get('telegram_chat_id'),
            'pond_name' => Setting::get('pond_name'),
            'api_token' => Setting::get('api_token'),
            'full_distance' => Setting::get('full_distance', '5'),
            'empty_distance' => Setting::get('empty_distance', '20'),
            'telegram_bot_token' => config('services.telegram-bot-api.token'),
        ];
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'servo_duration' => 'required|integer|min:1|max:60',
            'low_stock_threshold' => 'required|numeric|min:0|max:999.99',
            'offline_threshold' => 'required|integer|min:1|max:1440',
            'telegram_chat_id' => 'nullable|string|max:100',
            'pond_name' => 'required|string|max:100',
            'full_distance' => 'required|numeric|min:0|max:999.99',
            'empty_distance' => 'required|numeric|min:0|max:999.99|different:full_distance',
        ]);
        
        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan');
    }
}
