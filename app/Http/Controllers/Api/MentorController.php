<?php

namespace App\Http\Controllers\Api;

use App\Models\Mentor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            'image_url' => 'required|string',
            'skills' => 'array', // [1, 2, 3]
        ]);

        $mentor = Mentor::create($data);
        if ($request->has('skills')) {
            $mentor->skills()->sync($request->skills);
        }

        return $mentor->load('skills');
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
            'image_url' => 'sometimes|string',
            'skills' => 'array', // optional
        ]);

        $mentor->update($data);
        if ($request->has('skills')) {
            $mentor->skills()->sync($request->skills);
        }

        return $mentor->load('skills');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Mentor::destroy($id);
    }
}
