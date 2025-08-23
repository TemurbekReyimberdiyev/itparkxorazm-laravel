<?php

// app/Http/Controllers/Api/AuthController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if (! $admin || ! Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'Login yoki parol xato'], 401);
        }

        // Token yaratish (Laravel Sanctum kerak)
        $token = $admin->createToken('admin_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'admin' => $admin,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout muvaffaqiyatli']);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}
