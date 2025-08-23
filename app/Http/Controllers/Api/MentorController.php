<?php

namespace App\Http\Controllers\Api;

use App\Models\Mentor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Mentor::with('course', 'skills')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'education' => 'required|string',
            'experience_years' => 'required|integer',
            'students' => 'nullable|integer',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'skills' => 'array',
        ]);

        // Rasmni saqlash
        $path = $request->file('image')->store('mentors', 'public');
        $data['image_url'] = $path;

        $mentor = Mentor::create($data);

        if ($request->has('skills')) {
            $mentor->skills()->sync($request->skills);
        }

        return $mentor->load('course', 'skills');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Mentor::with('course', 'skills')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mentor = Mentor::findOrFail($id);

        $data = $request->validate([
            'first_name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'course_id' => 'sometimes|exists:courses,id',
            'education' => 'sometimes|string',
            'experience_years' => 'sometimes|integer',
            'students' => 'sometimes|integer',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'skills' => 'sometimes|array',
        ]);

        if ($request->hasFile('image')) {
            // Eski rasmni o‘chirish (ixtiyoriy)
            if ($mentor->image_url) {
                $oldPath = str_replace('/storage/', '', $mentor->image_url);
                Storage::disk('public')->delete($oldPath);
            }

            // Yangi rasmni saqlash
            $path = $request->file('image')->store('mentors', 'public');
            $data['image_url'] = $path;
        }

        $mentor->update($data);

        if ($request->has('skills')) {
            $mentor->skills()->sync($request->skills);
        }

        return $mentor->load('course', 'skills');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mentor = Mentor::findOrFail($id);

        // Eski rasmni o‘chirish
        if ($mentor->image_url) {
            $imagePath = str_replace('/storage/', '', $mentor->image_url);
            Storage::disk('public')->delete($imagePath);
        }

        $mentor->delete();

        return response()->json(['message' => 'Mentor o‘chirildi'], 200);
    }
}
