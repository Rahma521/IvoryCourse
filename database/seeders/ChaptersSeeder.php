<?php

namespace Database\Seeders;

use App\Models\Courses\Chapter;
use Illuminate\Database\Seeder;

class ChaptersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Chapter::create([
            'course_id' => 1,
            'name_ar' => 'الفصل الأول',
            'name_en' => 'First Chapter',

        ]);
    }
}
