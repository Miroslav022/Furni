<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Factory::create();
        for ($i=0; $i<20; $i++){
            $city = new City();
            $city->city = $faker->city();
            $city->country_id = $faker->numberBetween(1,10);
            $city->save();
        }
    }
}
