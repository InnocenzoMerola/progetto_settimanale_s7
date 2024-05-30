<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('activities')->insert([
            'name' => 'Crossfit',
            'description' => 'Allenamento di crossfit'
        ]);

        DB::table('activities')->insert([
            'name' => 'Sala',
            'description' => 'Allenamento in sala pesi'
        ]);

        for ($i=0; $i < 3; $i++) { 
            DB::table('activities')->insert([
                'name' => fake()->words(rand(1, 3), true),
                'description' => fake()->words(rand(4, 6), true)
            ]);
        }
    }
}
