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
        Schema::create('cite_inscription_versements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cite_inscription_id')->constrained('car_inscriptions')->cascadeOnDelete();
            $table->decimal('versement', 15, 2);
            $table->date('date_versement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cite_inscription_versements');
    }
};
