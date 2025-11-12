<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function store(LoginRequest $req)
    {
        $req->authenticate();

        $user = Auth::user();

        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "status" => true,
            "data" => [
                "accessToken" => $token,
                "userId" => $user->id,
                "userName" => $user->name
            ],
            "message" => "Login successful",
            "code" => 200
        ],200);
    }

    public function destroy(Request $request): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json([
                "status" => false,
                "message" =>  "Unauthorized",
                "code" => 401,
            ], 401);
        }

        $user = $request->user();

        $user->currentAccessToken()->delete();

        return response()->json([
            "status" => true,
            "data" => [],
            "message" => "Logged-out successfully",
            "code" => 200,
        ], 200);
    }
}
