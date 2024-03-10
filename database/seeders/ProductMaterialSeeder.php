<?php

namespace Database\Seeders;

use App\Models\ProductMaterial;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 1; $i<=31; $i++){
            $productMaterial = new ProductMaterial();
            $productMaterial->product_id = $i;
            $productMaterial->material_id = $faker->numberBetween(1, 10);
            $productMaterial->save();
        }
    }
}
