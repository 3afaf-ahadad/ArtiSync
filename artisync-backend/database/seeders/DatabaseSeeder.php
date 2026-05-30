<?php

namespace Database\Seeders;

use App\Models\Machine;
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

        User::updateOrCreate(
            ['email' => 'chef@artisync.ma'],
            [
                'name' => 'Chef de Pole',
                'password' => Hash::make('password123'),
                'role' => 'chef',
                'filiere' => null
            ]
        );

        User::updateOrCreate([
            'name' => 'Formateur Couture',
            'email' => 'formateur@artisync.ma',
            'password' => Hash::make('password123'),
            'role' => 'formateur',
            'filiere' => 'Haute Couture',
        ]);

        Machine::create([
            'name' => 'Fraiseuse CNC',
            'status' => 'en maintenance',
            'filiere' => 'Bijouterie'
        ]);

        Machine::create([
            'name' => 'Tour à bois',
            'status' => 'en panne',
            'filiere' => 'Menuiserie'
        ]);
    }
}
