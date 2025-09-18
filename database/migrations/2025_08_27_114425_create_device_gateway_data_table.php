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
        Schema::create('device_gateway_data', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Device::class)->nullable();
            $table->dateTime('start_unit_date')->nullable();
            $table->decimal('device_start_unit', 11, 0)->default(0);
            $table->decimal('tariff_per_unit', 11, 0)->default(0);
            $table->boolean('is_new_setup')->default(0);
            $table->decimal('consumed_unit', 11, 0)->default(0);
            $table->decimal('remaining_unit', 11, 0)->default(0);
            $table->decimal('load', 11, 0)->default(0);
            $table->decimal('balance', 11, 0)->default(0);
            $table->decimal('per_unit_charge', 11)->default(0);
            $table->string('label')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_gateway_data');
    }
};
