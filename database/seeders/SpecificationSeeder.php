<?php

namespace Database\Seeders;

use App\Models\Specification;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $faker = Factory::create();
        for($i = 0; $i < 20; $i++){
            $spec = new Specification();
            $spec->specification=$faker->text('15');
            $spec->save();

        }


//        DB::table('specifications')->insert($data);

    }
}
