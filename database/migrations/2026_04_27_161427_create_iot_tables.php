<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Kolam Utama');
            $table->timestamp('last_heartbeat')->nullable();
            $table->string('status')->default('offline');
            $table->boolean('manual_feed_pending')->default(false);
            $table->timestamps();
        });

        Schema::create('feeding_schedules', function (Blueprint $table) {
            $table->id();
            $table->time('time');
            $table->integer('duration');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('feeding_logs', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['otomatis', 'manual']);
            $table->integer('duration');
            $table->enum('status', ['sukses', 'gagal']);
            $table->timestamp('executed_at');
            $table->timestamps();
        });

        Schema::create('stock_logs', function (Blueprint $table) {
            $table->id();
            $table->decimal('distance', 5, 2);
            $table->integer('percentage')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('web_notifications', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['feed_failed', 'device_offline', 'low_stock']);
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('web_notifications');
        Schema::dropIfExists('stock_logs');
        Schema::dropIfExists('feeding_logs');
        Schema::dropIfExists('feeding_schedules');
        Schema::dropIfExists('devices');
    }
};
