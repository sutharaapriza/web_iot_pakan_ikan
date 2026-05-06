<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
        ]);

        // Default Settings
        $settings = [
            'servo_duration' => '3',
            'low_stock_threshold' => '15.0',
            'offline_threshold' => '5',
            'telegram_chat_id' => '',
            'pond_name' => 'Kolam Utama',
            'api_token' => \Illuminate\Support\Str::random(32),
        ];

        foreach ($settings as $key => $value) {
            \App\Models\Setting::create([
                'key' => $key,
                'value' => $value,
            ]);
        }

        // Default Device
        \App\Models\Device::create([
            'name' => 'Kolam Utama',
            'status' => 'offline',
        ]);
    }
}
