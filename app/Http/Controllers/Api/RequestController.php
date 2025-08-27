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
        // ✅ Bo‘sh stringlarni nullga aylantirish
        $data = $request->all();
        foreach (['mail', 'course_id', 'message'] as $field) {
            if (isset($data[$field]) && $data[$field] === '') {
                $data[$field] = null;
            }
        }

        $validator = Validator::make($data, [
            'name'      => 'required|string|max:255',
            'number'    => 'required|string|max:50',
            'mail'      => 'nullable|email',
            'course_id' => 'nullable|exists:courses,id',
            'message'   => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $created = Request::create($validator->validated());

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

        // ✅ Bo‘sh stringlarni nullga aylantirish
        $input = $request->all();
        foreach (['mail', 'course_id', 'message'] as $field) {
            if (isset($input[$field]) && $input[$field] === '') {
                $input[$field] = null;
            }
        }

        $validator = Validator::make($input, [
            'name'      => 'required|string|max:255',
            'number'    => 'required|string|max:50',
            'mail'      => 'nullable|email',
            'course_id' => 'nullable|exists:courses,id',
            'message'   => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
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
