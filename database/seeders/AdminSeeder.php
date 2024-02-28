<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       $user =  \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$zt66UzhflpCvf.gyvUJNF.kGEtVj4f0VuxRvSd6WdyXISlIlhw.TG', //admin@gmail.com
            'phone' => '123456789',
            'role_auth' => 'admin',
        ]);
        \App\Models\Administration::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$zt66UzhflpCvf.gyvUJNF.kGEtVj4f0VuxRvSd6WdyXISlIlhw.TG', //admin@gmail.com
            'phone' => '123456789',
            'address' => 'Abidjan',
            'avatar' => 'users/default.png',
            'role' => 'admin',
            'status' => 1,
            'responsability' => 'Administrateur principal du système',
            'gender' => 'M',
            'user_id' => $user->id,
        ]);

    }
}
