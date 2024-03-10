<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Laravel\Prompts\Table;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {

        $faker = Factory::create();

        for ($i = 0; $i<10; $i++) {
            $category = new Category();
            $category->category=$faker->text('20');
            $category->save();

        }


//        DB::table('categories')->insert($data);


    }
}
