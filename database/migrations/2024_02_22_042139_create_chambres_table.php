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
        Schema::create('chambres', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('slug')->unique();
            $table->string('type');
            $table->integer('capacity')->default(2);
            $table->string('status')->default('vide');
            $table->foreignId('cite_id')->constrained('cites')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('is_occupied')->default(false);
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chambres');
    }
};
