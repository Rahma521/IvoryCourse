<?php

namespace Database\Seeders;

use App\Models\Courses\Course;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'main_section_id' => 1,
            'sub_section_id' => 1,
            'instructor_id' => 1,
            'name_ar' => 'Introduction to Programming',
            'name_en' => 'Introduction to Programming8',
            'video_hosting' => true,
            'intro_video_url' => null,
            'description_ar' => 'A beginner course in programming.',
            'description_en' => 'A beginner course in programming.',
            'type' => 1,
            'language' => 1,
            'location' => 1,
            'is_free' => true,
            'price' => null,
            'discount_price' => null,
            'level' => 1,
            'keywords' => 'programming, coding, beginner',
            'meta_description' => 'An introductory course to programming.',
            'meta_tags' => null,
            'status' => 1,
        ]);
    }
}
