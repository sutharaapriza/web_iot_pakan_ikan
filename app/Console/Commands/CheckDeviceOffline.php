<?php

namespace App\Console\Commands;

use App\Models\Device;
use App\Models\Setting;
use App\Models\WebNotification;
use App\Notifications\IotNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class CheckDeviceOffline extends Command
{
    protected $signature = 'device:check-offline';

    protected $description = 'Check if device heartbeat is late and mark as offline';

    public function handle(): int
    {
        $threshold = (int) Setting::get('offline_threshold', 5);
        $device = Device::first();

        if (! $device || $device->status !== 'online' || ! $device->last_heartbeat) {
            return self::SUCCESS;
        }

        $lastHeartbeat = Carbon::parse($device->last_heartbeat);
        if ($lastHeartbeat->diffInMinutes(now()) < $threshold) {
            return self::SUCCESS;
        }

        $device->update(['status' => 'offline']);

        $message = 'ALAT TERPUTUS (OFFLINE)!'
            ."\nKolam: ".Setting::get('pond_name', 'Kolam Utama')
            ."\nTerakhir terlihat: ".$lastHeartbeat->format('d/m/Y H:i:s');

        WebNotification::create([
            'type' => 'device_offline',
            'message' => 'Alat terdeteksi offline! Terakhir terhubung: '.$lastHeartbeat->format('H:i:s'),
            'created_at' => now(),
        ]);

        if (Setting::get('telegram_chat_id')) {
            Notification::send(new Device(), new IotNotification($message));
        }

        $this->info('Device marked as offline.');

        return self::SUCCESS;
    }
}
