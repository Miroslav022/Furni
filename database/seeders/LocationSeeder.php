<?php

namespace Database\Seeders;

use App\Models\Location;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i<12; $i++){
            $location = new Location();
            $location->city_id = $faker->numberBetween(1,21);
            $location->address = $faker->address();
            $location->save();
        }
    }
}
