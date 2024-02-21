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
        Schema::create('details_payements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_scolarite_id')->constrained('payment_scolarites')->onDelete('cascade')->onUpdate('cascade');
            $table->float('amount');
            $table->string('observation')->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_payements');
    }
};
