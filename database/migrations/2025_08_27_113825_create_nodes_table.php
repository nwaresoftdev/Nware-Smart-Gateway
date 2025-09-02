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
        Schema::create('nodes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->nullable();
            $table->foreignIdFor(\App\Models\NodeType::class)->nullable();
            $table->foreignIdFor(\App\Models\NodeModel::class)->nullable();
            $table->foreignIdFor(\App\Models\DeviceGatewayData::class)->nullable();
            $table->foreignIdFor(\App\Models\Location::class)->nullable();
            $table->string('node_name', 255)->default('');
            $table->boolean('node_on_off')->default(0);
            $table->string('imei', 100)->default('');
            $table->string('serial_number', 100)->default('');
            $table->string('ssid', 100)->default('');
            $table->string('sku', 100)->default('');
            $table->boolean('is_active')->default(0);
            $table->string('firmware_version', 100)->default('');
            $table->string('connectivity_protocol', 100)->default('');
            $table->string('version', 50)->default('');
            $table->boolean('is_favourite')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nodes');
    }
};
