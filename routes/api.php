<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\MentorController;
use App\Http\Controllers\Api\MentorSkillController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\RequestController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\AuthController;


// Har bir resurs uchun CRUD API marshrutlari
Route::apiResource('categories', CategoryController::class);      // /api/categories
Route::apiResource('courses', CourseController::class);           // /api/courses
Route::apiResource('mentors', MentorController::class);           // /api/mentors
Route::apiResource('skills', SkillController::class);             // /api/skills
Route::apiResource('mentor-skills', MentorSkillController::class); // /api/mentor-skills
Route::apiResource('news', NewsController::class);                // /api/news
Route::apiResource('requests', RequestController::class);         // /api/requests

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // admin panel uchun API'lar shu yerda

});
