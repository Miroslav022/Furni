<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for($i=0; $i<5; $i++){
            $testimonial = new Testimonial();
            $testimonial->name = $faker->name();
            $testimonial->function = $faker->jobTitle();
            $testimonial->testimonial = $faker->text(80);
            $testimonial->save();
        }
    }
}
