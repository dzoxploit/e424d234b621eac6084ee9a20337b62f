<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class NewsTableSeeder extends Seeder
{
    public function run()
    {  $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            DB::table('news')->insert([
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
                'penulis_id' => 1,
                'kategori_id' => 1,
                'artis_id' => 1
            ]);
        }
    }
}
