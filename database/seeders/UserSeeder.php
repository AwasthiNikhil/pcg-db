<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'player1',
            'password' => Hash::make('password'),
            'coins' => 1000,
        ]);

        User::create([
            'username' => 'player2',
            'password' => Hash::make('password'),
            'coins' => 500,
        ]);
    }
}
