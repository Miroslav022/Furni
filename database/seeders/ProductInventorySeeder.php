<?php

namespace Database\Seeders;

use App\Models\ProductInventory;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductInventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for($i = 1; $i<32; $i++){
            $pi = new ProductInventory();
            $pi->product_id = $i;
            $pi->inventory_id = $faker->numberBetween(7,11);
            $pi->quantity = $faker->numberBetween(0,300);
            $pi->save();
        }
    }
}
