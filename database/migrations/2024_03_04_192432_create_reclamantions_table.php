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
        Schema::create('reclamantions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('etudiant_id')->unsigned()->nullable();
            $table->foreign('etudiant_id')->references('id')->on('etudiants')->onDelete('cascade');
            $table->bigInteger('evaluation_id')->unsigned()->nullable();
            $table->foreign('evaluation_id')->references('id')->on('evaluations')->onDelete('cascade');
            $table->bigInteger('examen_id')->unsigned()->nullable();
            $table->foreign('examen_id')->references('id')->on('examens')->onDelete('cascade');
            $table->text('message');
            $table->enum('status', ['pending', 'resolved'])->default('pending');
            $table->string('file')->nullable();
            $table->boolean('is_exam')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamantions');
    }
};
