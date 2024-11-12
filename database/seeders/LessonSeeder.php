<?php

namespace Database\Seeders;

use App\Models\courses\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lesson::create([
            'name_ar' => 'أساسيات الإسعافات الأولية',
            'name_en' => 'Basics of First Aid',
            'video_hosting' => 1,
            'video_url' => 'https://vimeo.com/basics_of_first_aid',
            'video_file' => null,
            'description_ar' => 'تعلم كيفية تقديم الإسعافات الأولية الأساسية.',
            'description_en' => 'Learn how to provide basic first aid.',
            'resources' => 'First Aid Kit Guide, Videos',
            'status' => 0,
        ]);
    }
}
