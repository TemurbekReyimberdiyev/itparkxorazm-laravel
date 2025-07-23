<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            'description'        => 'required|string',
            'image_url'   => 'nullable|url'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $news = News::create($request->all());
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
            'heading'       => 'required|string|max:255',
            'description'        => 'required|string',
            'image_url'   => 'nullable|url'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $news->update($request->all());

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

        $news->delete();

        return response()->json(['message' => 'News deleted'], 200);
    }
}
