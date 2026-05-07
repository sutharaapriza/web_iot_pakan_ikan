<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Setting;
use Illuminate\Http\Request;

class ControlController extends Controller
{
    public function index()
    {
        $defaultDuration = Setting::get('servo_duration', 3);
        $device = Device::first();
        return view('control.index', compact('defaultDuration', 'device'));
    }

    public function trigger(Request $request)
    {
        $request->validate([
            'duration' => 'required|integer|min:1|max:60',
        ]);

        $device = Device::firstOrCreate(
            [],
            ['name' => Setting::get('pond_name', 'Kolam Utama')]
        );

        $device->update([
            'manual_feed_pending' => true,
        ]);

        Setting::set('manual_feed_duration', $request->integer('duration'));

        return redirect()->back()->with('success', 'Perintah pakan manual telah dikirim ke alat.');
    }
}
