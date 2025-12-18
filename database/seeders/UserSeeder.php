<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Admin
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), // mot de passe par défaut
            'id_role' => 1, // admin
        ]);

        // Agent
        DB::table('users')->insert([
            'name' => 'Agent User',
            'email' => 'agent@gmail.com',
            'password' => Hash::make('password'),
            'id_role' => 2, // agent
        ]);

    }
}
