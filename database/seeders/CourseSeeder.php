<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Slot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\User;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activity_ids = Activity::all()->pluck('id')->all();
        $slot_ids = Slot::all()->pluck('id')->all();

        for ($i=0; $i < 5; $i++) { 
            DB::table('courses')->insert([
                'activity_id' => fake()->randomElement($activity_ids),
                'slot_id' => fake()->randomElement($slot_ids),
                'location' => fake()->words(rand(1, 3), true)
            ]);
        } 


        $users = User::all()->all();
        $course_ids = Course::all()->pluck('id')->all();

        foreach ($users as $user) {
            $courses_for_user = fake()->randomElements($course_ids, rand(1, count($course_ids)));
            foreach ($courses_for_user as $course_id) {
                $user->courses()->attach($course_id, ['status' => 'null']);
            }
        }
    }
}
