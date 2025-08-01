<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
            'email' => 'player1@gmail.com',
            'country' => 'NP',
            'avatar' => 'avatar.png',
            'coins' => 1000,
            'last_login' => now(),
        ]);

        User::create([
            'username' => 'player2',
            'password' => Hash::make('password'),
            'email' => 'player2@gmail.com',
            'country' => 'NP',
            'avatar' => 'avatar.png',
            'coins' => 500,
            'last_login' => now(),
        ]);

        $users = [
            [
                'username' => 'alice',
                'password' => Hash::make('password'),
                'email' => 'alice@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 100,
                'last_login' => now(),
                'status' => 'active',
            ],
            [
                'username' => 'bob',
                'password' => Hash::make('password'),
                'email' => 'bob@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 250,
                'last_login' => now(),
                'status' => 'active',
            ],
            [
                'username' => 'charlie',
                'password' => Hash::make('password'),
                'email' => 'charlie@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 500,
                'last_login' => now(),
                'status' => 'banned',
            ],
            [
                'username' => 'diana',
                'password' => Hash::make('password'),
                'email' => 'diana@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 75,
                'last_login' => now(),
                'status' => 'active',
            ],
            [
                'username' => 'eve',
                'password' => Hash::make('password'),
                'email' => 'eve@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 0,
                'last_login' => now(),
                'status' => 'banned',
            ],
            [
                'username' => 'frank',
                'password' => Hash::make('password'),
                'email' => 'frank@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 30,
                'last_login' => now(),
                'status' => 'active',
            ],
            [
                'username' => 'grace',
                'password' => Hash::make('password'),
                'email' => 'grace@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 800,
                'last_login' => now(),
                'status' => 'active',
            ],
            [
                'username' => 'henry',
                'password' => Hash::make('password'),
                'email' => 'henry@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 150,
                'last_login' => now(),
                'status' => 'banned',
            ],
            [
                'username' => 'irene',
                'password' => Hash::make('password'),
                'email' => 'irene@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 90,
                'last_login' => now(),
                'status' => 'active',
            ],
            [
                'username' => 'jack',
                'password' => Hash::make('password'),
                'email' => 'jack@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 60,
                'last_login' => now(),
                'status' => 'active',
            ],
            [
                'username' => 'kate',
                'password' => Hash::make('password'),
                'email' => 'kate@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 10,
                'last_login' => now(),
                'status' => 'active',
            ],
            [
                'username' => 'leo',
                'password' => Hash::make('password'),
                'email' => 'leo@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 500,
                'last_login' => now(),
                'status' => 'active',
            ],
            [
                'username' => 'mona',
                'password' => Hash::make('password'),
                'email' => 'mona@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 5,
                'last_login' => now(),
                'status' => 'banned',
            ],
            [
                'username' => 'nick',
                'password' => Hash::make('password'),
                'email' => 'nick@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 200,
                'last_login' => now(),
                'status' => 'active',
            ],
            [
                'username' => 'olivia',
                'password' => Hash::make('password'),
                'coins' => 300,
                'email' => 'olivia@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'last_login' => now(),
                'status' => 'active',
            ],
            [
                'username' => 'peter',
                'password' => Hash::make('password'),
                'email' => 'peter@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 110,
                'last_login' => now(),
                'status' => 'banned',
            ],
            [
                'username' => 'quincy',
                'password' => Hash::make('password'),
                'email' => 'quincy@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 0,
                'last_login' => now(),
                'status' => 'active',
            ],
            [
                'username' => 'rachel',
                'password' => Hash::make('password'),
                'email' => 'rachel@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 75,
                'last_login' => now(),
                'status' => 'active',
            ],
            [
                'username' => 'steve',
                'password' => Hash::make('password'),
                'email' => 'steve@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 400,
                'last_login' => now(),
                'status' => 'banned',
            ],
            [
                'username' => 'tina',
                'password' => Hash::make('password'),
                'email' => 'tina@gmail.com',
                'country' => 'NP',
                'avatar' => 'avatar.png',
                'coins' => 600,
                'last_login' => now(),
                'status' => 'active',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
