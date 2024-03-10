<?php

namespace Database\Seeders;

use App\Models\Material;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i<10; $i++){
            $material = new Material();
            $material->material = $faker->text(10);
            $material->save();
        }
    }
}
