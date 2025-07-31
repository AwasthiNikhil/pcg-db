<?php

namespace Database\Seeders;

use App\Models\Score;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Score::insert([
        //     [
        //         'user_id' => 1,
        //         'level' => 1,
        //         'score' => 180,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'user_id' => 1,
        //         'level' => 2,
        //         'score' => 200,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'user_id' => 2,
        //         'level' => 1,
        //         'score' => 120,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);

    for ($userId = 1; $userId <= 22; $userId++) {
        for ($level = 1; $level <= 5; $level++) {
            DB::table('scores')->insert([
                'user_id' => $userId,
                'level' => $level,
                'score' => rand(100, 1000), // hardcoded randomness; can be replaced manually if needed
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    }
}
