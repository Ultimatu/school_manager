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
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('classe_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('professeur_id')->constrained('professeurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['classe_id']);
            $table->dropForeign(['professeur_id']);
            $table->dropColumn(['classe_id', 'professeur_id']);
        });
    }
};
