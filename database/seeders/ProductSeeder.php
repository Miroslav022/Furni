<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $faker = Factory::create();
        for($i = 0; $i <=30; $i++){
            $product = new Product();
            $product->product_name=$faker->text('20');
            $product->category_id= $faker->numberBetween(1,10);
            $product->bg_image="product-1.png";
            $product->description = $faker->text('100');
            $product->save();

        }


//        DB::table("products")->insert($data);
    }
}
