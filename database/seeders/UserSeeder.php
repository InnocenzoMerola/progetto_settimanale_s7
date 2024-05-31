<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Enzo',
            'email' => 'enzo@enzo.com',
            'password' => bcrypt('Enzomerola'),
            'role' => 'admin',
        ]);

        // User::factory(5)->create();

        
    }
}
