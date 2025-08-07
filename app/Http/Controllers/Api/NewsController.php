<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(News::latest()->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'heading'       => 'required|string|max:255',
            'description'   => 'required|string',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->only(['heading', 'description']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $news = News::create($data);
        return response()->json($news, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        return response()->json($news, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'heading'       => 'sometimes|string|max:255',
            'description'   => 'sometimes|string',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->only(['heading', 'description']);

        if ($request->hasFile('image')) {
            // eski rasmni o‘chirish
            if ($news->image_url) {
                $oldPath = str_replace('/storage/', '', $news->image_url);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('image')->store('news', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $news->update($data);

        return response()->json($news, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        if ($news->image_url) {
            $imagePath = str_replace('/storage/', '', $news->image_url);
            Storage::disk('public')->delete($imagePath);
        }

        $news->delete();

        return response()->json(['message' => 'News deleted'], 200);
    }
}
