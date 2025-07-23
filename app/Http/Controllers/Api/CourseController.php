<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Course::with('category', 'mentors')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'heading' => 'required|string',
            'description' => 'required|string',
            'duration_month' => 'required|integer',
            'image_url' => 'required|string',
            'cost' => 'required|integer',
        ]);

        return Course::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Course::with('category', 'mentors')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);

        $data = $request->validate([
            'category_id' => 'sometimes|exists:categories,id',
            'name' => 'sometimes|string',
            'heading' => 'sometimes|string',
            'description' => 'sometimes|string',
            'duration_month' => 'sometimes|integer',
            'image_url' => 'sometimes|string',
            'cost' => 'sometimes|integer',
        ]);

        $course->update($data);

        return $course;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Course::destroy($id);
    }
}
