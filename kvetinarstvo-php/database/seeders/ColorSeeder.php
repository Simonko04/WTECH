<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('colors')->insert([

            // ID = 1
            ['name' => 'Biela',  'created_at' => now(), 'updated_at' => now()],
            // ID = 2
            ['name' => 'Ružová',  'created_at' => now(), 'updated_at' => now()],
            // ID = 3
            ['name' => 'Červená',  'created_at' => now(), 'updated_at' => now()],
            // ID = 4
            ['name' => 'Fialová',  'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
