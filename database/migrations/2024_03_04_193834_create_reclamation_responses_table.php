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
        Schema::create('reclamation_responses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reclamantion_id')->unsigned();
            $table->foreign('reclamantion_id')->references('id')->on('reclamantions')->onDelete('cascade');
            $table->text('message');
            $table->date('date')->default(now());
            $table->string('piece_jointe')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamation_responses');
    }
};
