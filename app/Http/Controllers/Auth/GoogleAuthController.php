<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver("google")->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver("google")->user();

        $user = User::updateOrCreate(
            [
                "google_id" => $googleUser->id,
            ],
            [
                "name" => $googleUser->name,
                "email" => $googleUser->email,
                "password" => Hash::make(Str::password(12)),
                "email_verified_at" => now(),
            ]
        );

        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "status" => true,
            "data" =>[
                "accessToken" => $token,
                "userId" => $user->id,
                "userName" => $user->name,
            ],
            "message" => "Login successfully",
            "code" => 200
        ],200);
    }
}
