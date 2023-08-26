<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenulisTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('penulis')->insert([
            'name' => 'didin nur yahya',
            'email' => 'admindidin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
