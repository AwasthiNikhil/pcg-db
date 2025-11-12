<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Item::insert([
            [
                'name' => 'Speed Boost',
                'type' => 'powerup',
                'description' => 'Temporarily increases movement speed.',
                'price' => 50,
                'rarity' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wall',
                'type' => 'item',
                'description' => 'Use ingame to place walls. Make or block ways, up to you.',
                'price' => 40,
                'rarity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bomb',
                'type' => 'item',
                'description' => 'Use ingame to destory walls or enemies.',
                'price' => 40,
                'rarity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Golden Skin',
                'type' => 'skin',
                'description' => 'Shiny gold outfit for your character.',
                'price' => 500,
                'rarity' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
