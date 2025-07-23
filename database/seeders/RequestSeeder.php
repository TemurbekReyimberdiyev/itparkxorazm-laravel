<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Request;
use App\Models\Course;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Avval hech bo'lmaganda 1 ta course borligini tekshirish
        if (Course::count() === 0) {
            \App\Models\Category::firstOrCreate(['name' => 'Default']);
            Course::create([
                'category_id' => 1,
                'name' => 'Fullstack Web Development',
                'heading' => 'Laravel + Vue 3',
                'description' => 'A powerful combo for modern web applications.',
                'duration_month' => 3,
                'image_url' => 'https://via.placeholder.com/600x400',
                'cost' => 800000,
            ]);
        }

        $course = Course::first();

        Request::insert([
            [
                'name'      => 'Ali Valiyev',
                'number'    => '+998901234567',
                'mail'      => 'ali@example.com',
                'course_id' => $course->id,
                'message'   => 'Menga kurs haqida batafsil ma’lumot bering.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'      => 'Malika Karimova',
                'number'    => '+998939876543',
                'mail'      => 'malika@example.com',
                'course_id' => $course->id,
                'message'   => 'Ro‘yxatdan o‘tmoqchiman.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
