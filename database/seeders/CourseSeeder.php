<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;


class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Avval kamida bitta category borligiga ishonch hosil qilamiz
        if (\App\Models\Category::count() == 0) {
            \App\Models\Category::create(['name' => 'General']);
        }

        $categoryId = \App\Models\Category::first()->id;

        Course::insert([
            [
                'category_id'    => $categoryId,
                'name'           => 'Frontend Bootcamp',
                'heading'        => 'HTML, CSS, JavaScript, Vue.js',
                'description'    => 'This course covers everything from basics to advanced frontend web development.',
                'duration_month' => 3,
                'image_url'      => 'https://via.placeholder.com/400x300',
                'cost'           => 500000,
            ],
            [
                'category_id'    => $categoryId,
                'name'           => 'Backend Laravel Course',
                'heading'        => 'PHP 8, Laravel 10, RESTful API',
                'description'    => 'Become a backend developer using Laravel framework and modern PHP.',
                'duration_month' => 4,
                'image_url'      => 'https://via.placeholder.com/400x300',
                'cost'           => 650000,
            ],
            [
                'category_id'    => $categoryId,
                'name'           => 'Mobile Development (Flutter)',
                'heading'        => 'Cross-platform Android & iOS Apps',
                'description'    => 'Master mobile app development using Dart and Flutter SDK.',
                'duration_month' => 3,
                'image_url'      => 'https://via.placeholder.com/400x300',
                'cost'           => 700000,
            ],
        ]);
    }
}
