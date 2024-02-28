<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnneeScolaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\AnneeScolaire::create([
            'annee_scolaire'=>'2023-2024',
            'debut'=>'2023-09-15',
            'fin'=>'2024-07-10',
            'status'=>'en cours',
            'is_finish'=>false
        ]);
    }
}
