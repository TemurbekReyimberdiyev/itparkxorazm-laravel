<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\MentorController;
use App\Http\Controllers\Api\SkillController;

Route::apiResource('courses', CourseController::class);
Route::apiResource('mentors', MentorController::class);
Route::apiResource('skills', SkillController::class);
