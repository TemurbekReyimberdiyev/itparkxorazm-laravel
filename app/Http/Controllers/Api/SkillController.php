<?php

namespace App\Http\Controllers\Api;

use App\Models\Skill;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    public function index()
    {
        return Skill::with('mentors')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $path = $request->file('image')->store('skills', 'public');

        $skill = Skill::create([
            'name' => $data['name'],
            'image_path' => $path, // ✅ image_url emas, image_path
        ]);

        return response()->json($skill, 201);
    }

    public function show(string $id)
    {
        return Skill::with('mentors')->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $skill = Skill::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($skill->image_path && Storage::disk('public')->exists($skill->image_path)) {
                Storage::disk('public')->delete($skill->image_path);
            }

            $data['image_path'] = $request->file('image')->store('skills', 'public');
        }

        $skill->update($data);

        return response()->json($skill, 200);
    }

    public function destroy(string $id)
    {
        $skill = Skill::findOrFail($id);

        if ($skill->image_path && Storage::disk('public')->exists($skill->image_path)) {
            Storage::disk('public')->delete($skill->image_path);
        }

        $skill->delete();

        return response()->json(['message' => 'Skill deleted'], 200);
    }
}
