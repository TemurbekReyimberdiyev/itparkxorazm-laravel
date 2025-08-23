<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'cost' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Rasmni saqlash
        $path = $request->file('image')->store('courses', 'public');

        // MassAssignment xatosini oldini olish uchun `image` ni olib tashlaymiz
        unset($data['image']);

        // Bazaga saqlanadigan nisbiy yo‘l
        $data['image_url'] = $path;

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
            'cost' => 'sometimes|integer',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Eski rasmni o'chirish (ixtiyoriy)
            if ($course->image_url) {
                $oldPath = str_replace('/storage/', '', $course->image_url);
                Storage::disk('public')->delete($oldPath);
            }

            // Yangi rasmni yuklash
            $path = $request->file('image')->store('courses', 'public');
            $data['image_url'] = $path;
        }

        $course->update($data);

        return $course;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);

        // Rasmni o‘chirish (ixtiyoriy)
        if ($course->image_url) {
            $imagePath = str_replace('/storage/', '', $course->image_url);
            Storage::disk('public')->delete($imagePath);
        }

        $course->delete();

        return response()->json(['message' => 'Kurs o‘chirildi'], 200);
    }
}
