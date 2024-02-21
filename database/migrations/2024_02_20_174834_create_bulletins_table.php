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
        Schema::create('bulletins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classe_cours_id')->constrained('classe_cours')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade')->onUpdate('cascade');
            $table->float('moyenne');
            $table->string('mention');
            $table->string('appreciation');
            $table->string('rang');
            $table->string('decision');
            $table->string('annee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulletins');
    }
};
