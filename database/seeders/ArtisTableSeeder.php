<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArtisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = Faker::create();

        foreach (range(1, 10) as $index) { // Change 10 to the number of artists you want
            DB::table('artis')->insert([
                'name' => $faker->name, // Use Faker to generate a fake artist name
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
