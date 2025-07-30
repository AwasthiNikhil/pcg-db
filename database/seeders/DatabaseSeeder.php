<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\UserSettingSeeder;
use Database\Seeders\ScoreSeeder;
use Database\Seeders\ItemSeeder;
use Database\Seeders\UserItemSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(UserSeeder::class);
        $this->call(UserSettingSeeder::class);
        $this->call(ScoreSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(UserItemSeeder::class);

    }
}
