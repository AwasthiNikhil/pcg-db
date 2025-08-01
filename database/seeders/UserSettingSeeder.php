<?php

namespace Database\Seeders;

use App\Models\UserSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($userId = 1; $userId <= 22; $userId++) {
            DB::table('user_settings')->insert([
                'user_id' => $userId,
                'master_volume' => 50,
                'music_volume' => 100,
                'sfx_volume' => 100,
                'keyboard_bindings' => json_encode(
                    ['jump' => 87, 'shoot' => 32, 'move_left' => 65, 'move_right' => 68, 'place_wall' => 69, 'place_wall_below' => 83]
                ),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
