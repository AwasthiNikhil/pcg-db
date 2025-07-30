<?php

namespace Database\Seeders;

use App\Models\UserItem;
use Illuminate\Database\Seeder;

class UserItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserItem::insert([
            [
                'user_id' => 1,
                'item_id' => 1, // Speed Boost
                'quantity' => 3,
            ],
            [
                'user_id' => 1,
                'item_id' => 3, // Golden Skin
                'quantity' => 1,
            ],
            [
                'user_id' => 2,
                'item_id' => 2, // Health Potion
                'quantity' => 5,
            ],
        ]);
    }
}
