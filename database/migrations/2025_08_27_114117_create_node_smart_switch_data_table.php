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
        Schema::create('node_smart_switch_data', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Node::class)->nullable();
            $table->string('node_line_on_off', 256)->default('0');
            $table->string('node_line_load', 256)->default('0');
            $table->dateTime('data_timestamp')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('node_smart_switch_data');
    }
};
