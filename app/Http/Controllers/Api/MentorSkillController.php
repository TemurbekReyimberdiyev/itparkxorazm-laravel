<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MentorSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($mentorId)
    {
        $mentor = Mentor::with('skills')->findOrFail($mentorId);
        return response()->json($mentor->skills, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $mentorId)
    {
        $request->validate([
            'skill_ids' => 'required|array',
            'skill_ids.*' => 'exists:skills,id',
        ]);

        $mentor = Mentor::findOrFail($mentorId);
        $mentor->skills()->syncWithoutDetaching($request->skill_ids);

        return response()->json(['message' => 'Skills attached successfully'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($mentorId, $skillId)
    {
        $mentor = Mentor::findOrFail($mentorId);
        $mentor->skills()->detach($skillId);

        return response()->json(['message' => 'Skill detached successfully'], 200);
    }
}
