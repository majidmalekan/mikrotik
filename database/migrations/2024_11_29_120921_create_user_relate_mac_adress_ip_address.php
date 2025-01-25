<?php

use App\Models\IpAddress;
use App\Models\MacAddress;
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
        Schema::create('user_related_mac_address_ip_address', function (Blueprint $table) {
            $table->foreignIdFor(IpAddress::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(MacAddress::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_related_mac_address_ip_address');
    }
};
