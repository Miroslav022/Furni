<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i=1; $i<31; $i++){
            DB::table('product_specification')->insert(['product_id'=>$i, "specification_id"=>$faker->numberBetween(1,20), 'value'=>$faker->text(10)]);
        }
    }
}
