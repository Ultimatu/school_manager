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
        Schema::table('notes', function (Blueprint $table) {
            //supprimer professeur_id, classe_cours_id car il sont dans une classe Evaluation maintenant, et ajouter evalutation_id
            $table->dropForeign(['professeur_id']);
            $table->dropForeign(['classe_cours_id']);
            $table->dropColumn(['professeur_id', 'classe_cours_id']);
            $table->foreignId('evaluation_id')->constrained('evaluations')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            //
        });
    }
};
