<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('secret123'),
        ]);
        User::create([
            'username' => 'player1',
            'password' => Hash::make('password'),
            'coins' => 1000,
            'last_login'=> now(),
        ]);

        User::create([
            'username' => 'player2',
            'password' => Hash::make('password'),
            'coins' => 500,
            'last_login'=> now(),
        ]);
    }
}
