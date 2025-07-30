<?php

namespace Database\Seeders;

use App\Models\UserSetting;
use Illuminate\Database\Seeder;

class UserSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserSetting::insert([
            [
                'user_id' => 1,
                'master_volume' => 80,
                'music_volume' => 60,
                'sfx_volume' => 70,
                'keyboard_bindings' => json_encode([
                    'move_left' => 'A',
                    'move_right' => 'D',
                    'jump' => 'W',
                    'shoot' => 'Space',
                    'place_wall' => 'E',
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 1,
                'master_volume' => 80,
                'music_volume' => 60,
                'sfx_volume' => 70,
                'keyboard_bindings' => json_encode([
                    'move_left' => 'A',
                    'move_right' => 'D',
                    'jump' => 'W',
                    'shoot' => 'Space',
                    'place_wall' => 'E',
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
