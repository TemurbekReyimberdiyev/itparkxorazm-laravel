<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\MentorController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MentorSkillController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\RequestController;

Route::apiResource('courses', CourseController::class);
Route::apiResource('mentors', MentorController::class);
Route::apiResource('skills', SkillController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('MentorSkill', MentorSkillController::class);
Route::apiResource('news', NewsController::class);
Route::apiResource('requests', RequestController::class);
