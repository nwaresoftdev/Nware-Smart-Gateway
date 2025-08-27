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
            $table->foreignIdFor(\App\Models\DeviceType::class)->nullable();
            $table->foreignIdFor(\App\Models\DeviceModel::class)->nullable();
            $table->foreignIdFor(\App\Models\DeviceGroup::class)->nullable();
            $table->foreignIdFor(\App\Models\Orgnization::class)->nullable();
            $table->foreignIdFor(\App\Models\User::class)->nullable();
            $table->string('device_name')->nullable();
            $table->boolean('device_on_off')->default(0);
            $table->unsignedBigInteger('location_id')->nullable();
            $table->string('imei')->nullable()->unique();
            $table->string('serial_number')->nullable()->unique();
            $table->string('ssid')->nullable();
            $table->string('sku')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('firmware_version')->nullable();
            $table->string('connectivity_protocol')->nullable();
            $table->string('version')->nullable();
            $table->boolean('is_favourite')->default(0);
            $table->foreignIdFor(\App\Models\Device::class)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
