<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Chef de Pole',
            'email' => 'chef@artisync.ma',
            'password' => Hash::make('password123'),
            'role' => 'chef',
            'filiere' => null,
        ]);

        User::create([
            'name' => 'Formateur Couture',
            'email' => 'formateur@artisync.ma',
            'password' => Hash::make('password123'),
            'role' => 'formateur',
            'filiere' => 'Haute Couture',
        ]);
    }
}
