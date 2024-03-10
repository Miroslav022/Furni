<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for($i = 0; $i<5; $i++){
            $inventory = new Inventory();
            $inventory->location_id = $faker->numberBetween(1,12);
            $inventory->save();
        }
    }
}
