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
        Schema::create('network_logs', function (Blueprint $table) {
            $table->id();
            $table->string('mac_address')->nullable();
            $table->ipAddress()->nullable();
            $table->bigInteger('download_bytes')->default(0);
            $table->bigInteger('upload_bytes')->default(0);
            $table->timestamp('logged_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('network_logs');
    }
};
