<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mentor;
use App\Models\Course;
use App\Models\Skill;

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Agar course yoki skilllar mavjud bo'lmasa, to'ldirib olish
        if (Course::count() == 0) {
            Course::create([
                'category_id' => 1,
                'name' => 'Backend Development',
                'heading' => 'Laravel + MySQL',
                'description' => 'Learn backend using PHP and Laravel',
                'duration_month' => 3,
                'image_url' => 'https://via.placeholder.com/300',
                'cost' => 600000,
            ]);
        }

        if (Skill::count() == 0) {
            Skill::insert([
                ['name' => 'Laravel'],
                ['name' => 'MySQL'],
                ['name' => 'Git'],
            ]);
        }

        $course = Course::first();
        $skillIds = Skill::pluck('id')->toArray();

        // Mentor yaratish
        $mentor = Mentor::create([
            'first_name' => 'Jamshid',
            'last_name' => 'Rasulov',
            'course_id' => $course->id,
            'education' => 'TATU, Kompyuter Injiniring',
            'experience_years' => 5,
            'students' => 120,
            'image_url' => 'https://via.placeholder.com/150',
        ]);

        // Skilllarni biriktirish (pivot)
        $mentor->skills()->sync($skillIds); // barcha skill larni biriktirish
    }
}
