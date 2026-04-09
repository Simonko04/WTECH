<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([

            // ID = 1
            ['name' => 'Svadby a oslavy',  'created_at' => now(), 'updated_at' => now()],
            // ID = 2
            ['name' => 'Romantika a narodeniny',  'created_at' => now(), 'updated_at' => now()],
            // ID = 3
            ['name' => 'Sústrasť',  'created_at' => now(), 'updated_at' => now()],
            // ID = 4
            ['name' => 'Firemné darčeky',  'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
