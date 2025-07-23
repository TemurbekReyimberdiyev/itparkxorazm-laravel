<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Request::with('course')->latest()->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'number'    => 'required|string|max:50',
            'mail'      => 'required|email',
            'course_id' => 'required|exists:courses,id',
            'message'   => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $created = Request::create($request->all());

        return response()->json([
            'message' => 'Request submitted successfully',
            'data' => $created
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $request = Request::with('course')->find($id);

        if (!$request) {
            return response()->json(['message' => 'Request not found'], 404);
        }

        return response()->json($request, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Request::find($id);

        if (!$data) {
            return response()->json(['message' => 'Request not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'number'    => 'required|string|max:50',
            'mail'      => 'required|email',
            'course_id' => 'required|exists:courses,id',
            'message'   => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data->update($request->all());

        return response()->json([
            'message' => 'Request updated successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $request = Request::find($id);

        if (!$request) {
            return response()->json(['message' => 'Request not found'], 404);
        }

        $request->delete();

        return response()->json(['message' => 'Request deleted'], 200);
    }
}
