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
        Schema::table('annee_scolaires', function (Blueprint $table) {
            $table->string('status')->default('en_cours');
            $table->string('annee_scolaire')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('annee_scolaires', function (Blueprint $table) {
            //
        });
    }
};
