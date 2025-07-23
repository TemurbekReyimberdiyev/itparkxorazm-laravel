<?php

namespace App\Http\Controllers\Api;

use App\Models\Skill;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            'image_url' => 'required|string',
        ]);

        return Skill::create($data);
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
            'image_url' => 'sometimes|string',
        ]);

        $skill->update($data);

        return $skill;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Skill::destroy($id);
    }
}
