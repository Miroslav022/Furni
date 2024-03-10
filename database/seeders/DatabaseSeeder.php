<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            SpecificationSeeder::class,
            ProductSeeder::class,
            RoleSeeder::class,
            PriceSeeder::class,
            Product_SpecificationSeeder::class,
            CountrySeeder::class,
            CitySeeder::class
        ]);
    }
}
