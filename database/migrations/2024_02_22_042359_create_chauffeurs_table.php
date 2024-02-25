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
        Schema::create('chauffeurs', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address')->nullable();
            $table->string('avatar')->default('users/default.png');
            $table->string('slug')->unique();
            $table->string('phone')->unique();
            $table->string('status')->default('en_service');
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('trajet_id')->constrained('trajets')->onDelete('cascade')->onUpdate('cascade');
            $table->string('annee_scolaire')->default('2023-2024');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chauffeurs');
    }
};
