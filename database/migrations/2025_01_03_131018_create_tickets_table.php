<?php

use App\Models\User;
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->enum('priority', ['emergency', 'high', 'low', 'middle']);
            $table->enum('status', ['pending', 'closed', 'answered'])->default('pending');
            $table->enum('department', ['financial', 'technical', 'sales'])->default('sales');
            $table->foreignIdFor(User::class,'user_id_from');
            $table->foreignIdFor(User::class, 'user_id_to')->nullable();
            $table->nestedSet();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
