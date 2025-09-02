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
        Schema::create('node_camera_data', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Node::class)->nullable();
            $table->boolean('node_on_off')->default(0);
            $table->dateTime('data_timestamp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('node_camera_data');
    }
};
