<?php

namespace Database\Seeders;

use App\Models\Price;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for($i=1; $i<=31; $i++){
            $price = new Price();
            $price->price= $faker->numberBetween(10,1000);
            $price->product_id = $i;
            $price->is_active = 1;
            $price->save();
        }
    }
}
