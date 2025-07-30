<?php

namespace Database\Seeders;

use App\Models\Score;
use Illuminate\Database\Seeder;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Score::insert([
            [
                'user_id' => 1,
                'level' => 1,
                'score' => 180,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'level' => 2,
                'score' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'level' => 1,
                'score' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
