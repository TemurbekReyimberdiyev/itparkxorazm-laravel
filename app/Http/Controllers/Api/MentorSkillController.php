<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mentor;

class MentorSkillController extends Controller
{
    public function index()
    {
        $mentors = Mentor::with('skills')->paginate(10);
        return response()->json($mentors, 200);
    }

    public function store(Request $request, $mentorId)
    {
        $request->validate([
            'skill_ids' => 'required|array',
            'skill_ids.*' => 'exists:skills,id',
        ]);

        $mentor = Mentor::findOrFail($mentorId);

        // Faqat yangi qo‘shish:
        $mentor->skills()->syncWithoutDetaching($request->skill_ids);

        // Agar to‘liq almashtirmoqchi bo‘lsangiz:
        // $mentor->skills()->sync($request->skill_ids);

        return response()->json(['message' => 'Skills attached successfully'], 200);
    }

    public function destroy(Request $request, $mentorId)
    {
        $request->validate([
            'skill_ids' => 'required|array',
            'skill_ids.*' => 'exists:skills,id',
        ]);

        $mentor = Mentor::findOrFail($mentorId);
        $mentor->skills()->detach($request->skill_ids);

        return response()->json(['message' => 'Skills detached successfully'], 200);
    }
}
