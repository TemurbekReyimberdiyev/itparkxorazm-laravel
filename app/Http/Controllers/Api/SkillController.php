<?php

namespace App\Http\Controllers\Api;

use App\Models\Skill;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Skill::with('mentors')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Faylni saqlash
        $path = $request->file('image')->store('skills', 'public');

        $skill = Skill::create([
            'name' => $data['name'],
            'image_url' => $path,
        ]);

        return response()->json($skill, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Skill::with('mentors')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $skill = Skill::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Eski rasmni o‘chirish (agar mavjud bo‘lsa)
            if ($skill->image_url && Storage::disk('public')->exists($skill->image_url)) {
                Storage::disk('public')->delete($skill->image_url);
            }

            // Yangi rasmni saqlash
            $data['image_url'] = $request->file('image')->store('skills', 'public');
        }

        $skill->update($data);

        return response()->json($skill, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skill = Skill::findOrFail($id);

        // Rasmni o‘chirish
        if ($skill->image_url && Storage::disk('public')->exists($skill->image_url)) {
            Storage::disk('public')->delete($skill->image_url);
        }

        $skill->delete();

        return response()->json(['message' => 'Skill deleted'], 200);
    }
}
