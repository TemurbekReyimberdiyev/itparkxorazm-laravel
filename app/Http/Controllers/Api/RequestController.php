<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as HttpRequest;
use App\Models\Request;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    public function index()
    {
        return response()->json(Request::with('course')->latest()->get(), 200);
    }

    public function store(HttpRequest $request)
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

        $validated = $validator->validated();
        $created = Request::create($validated);

        return response()->json([
            'message' => 'Request submitted successfully',
            'data' => $created
        ], 201);
    }

    public function show($id)
    {
        $request = Request::with('course')->find($id);

        if (!$request) {
            return response()->json(['message' => 'Request not found'], 404);
        }

        return response()->json($request, 200);
    }

    public function update(HttpRequest $request, $id)
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

        $data->update($validator->validated());

        return response()->json([
            'message' => 'Request updated successfully',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $request = Request::find($id);

        if (!$request) {
            return response()->json(['message' => 'Request not found'], 404);
        }

        $request->delete();

        return response()->json(['message' => 'Request deleted'], 200);
    }
}
