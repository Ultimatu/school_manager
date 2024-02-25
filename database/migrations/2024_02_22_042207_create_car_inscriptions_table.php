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
        Schema::create('car_inscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade');
            $table->foreignId('trajet_id')->constrained('trajets')->onDelete('cascade');
            $table->boolean('is_paid')->default(false);
            $table->json('versements')->nullable();
            $table->double('total_amount')->default(160000);
            $table->string('annee_scolaire')->default('2023-2024');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_inscriptions');
    }
};
