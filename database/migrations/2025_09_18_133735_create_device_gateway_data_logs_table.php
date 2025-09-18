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
        Schema::create('device_gateway_data_logs', function (Blueprint $table) {
            $table->id();
            $table->string('model')->nullable();
            $table->string('type')->nullable();
            $table->string('imei')->nullable();
            $table->string('header')->nullable();

            $table->decimal('cum_eb_kwh', 10, 3)->nullable();
            $table->decimal('cum_dg_kwh', 10, 3)->nullable();
            $table->integer('relay_status')->nullable();
            $table->integer('eb_dg_status')->nullable();
            $table->decimal('eb_load_setting', 10, 2)->nullable();
            $table->decimal('dg_load_setting', 10, 2)->nullable();
            $table->string('meter_serial_number')->nullable();
            $table->string('rtc_date_ddmmyy')->nullable();
            $table->string('rtc_time_hhmmss')->nullable();
            $table->decimal('eb_terriff_setting', 10, 2)->nullable();
            $table->decimal('dg_terrif_setting', 10, 2)->nullable();
            $table->decimal('balance_amount', 10, 2)->nullable();
            $table->decimal('daily_charge_setting', 10, 2)->nullable();
            $table->integer('no_of_over_load_check')->nullable();
            $table->integer('over_load_delay_between_two_attemps')->nullable();
            $table->integer('over_load_check_time_in_second')->nullable();

            // Balance updates
            for ($i = 1; $i <= 12; $i++) {
                $suffix = $i === 1 ? '' : "{$i}th_";
                $table->decimal("{$suffix}balance_update", 10, 2)->nullable();
            }

            $table->decimal('frequency', 10, 2)->nullable();
            $table->decimal('voltage_r', 10, 2)->nullable();
            $table->decimal('voltage_y', 10, 2)->nullable();
            $table->decimal('voltage_b', 10, 2)->nullable();
            $table->decimal('current_r', 10, 3)->nullable();
            $table->decimal('current_y', 10, 3)->nullable();
            $table->decimal('current_b', 10, 3)->nullable();
            $table->decimal('pf', 5, 2)->nullable();

            // Loads
            foreach (['kw', 'kva', 'kvar'] as $type) {
                foreach (['r', 'y', 'b'] as $phase) {
                    $table->decimal("{$type}_load_{$phase}", 10, 3)->nullable();
                }
            }

            // Balance deductions
            for ($i = 1; $i <= 10; $i++) {
                $suffix = $i === 1 ? '' : "{$i}th_";
                $table->decimal("{$suffix}balance_deduction", 10, 2)->nullable();
            }

            $table->decimal('cum_kvah', 10, 3)->nullable();
            $table->decimal('cum_kvah_dg', 10, 3)->nullable();
            $table->decimal('cum_kvarh', 10, 3)->nullable();
            $table->decimal('cum_kvarh_dg', 10, 3)->nullable();
            $table->decimal('cum_eb_kwh_40060', 10, 3)->nullable();
            $table->decimal('cum_dg_kwh_40061', 10, 3)->nullable();
            $table->decimal('total_kw', 10, 3)->nullable();
            $table->decimal('total_kva', 10, 3)->nullable();
            $table->decimal('total_kvar', 10, 3)->nullable();

            // Extra fields
            for ($i = 40065; $i <= 40070; $i++) {
                $table->string("na_{$i}")->nullable();
            }

            $table->integer('induvisal_relay_status_dg')->nullable();
            $table->integer('induvisal_relay_status_eb')->nullable();
            $table->integer('over_aattp_eb')->nullable();
            $table->integer('over_aattp_dg')->nullable();
            $table->string('na_40075')->nullable();

            $table->string('version')->nullable();
            $table->string('crc')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_gateway_data_logs');
    }
};
