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
                'name' => 'Health Potion',
                'type' => 'powerup',
                'description' => 'Restores full health.',
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
