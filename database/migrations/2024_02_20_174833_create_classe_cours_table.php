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
        Schema::create('classe_cours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classe_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('cours_id')->constrained('cours')->onDelete('cascade');
            $table->boolean('is_available')->default(1);
            $table->boolean('is_done')->default(0);
            $table->string('semester')->default('1');
            $table->integer('credit')->default(3);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->foreignId('professor_id')->constrained('professeurs')->onDelete('cascade');
            $table->float('total_hours')->default(60);  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classe_cours');
    }
};
