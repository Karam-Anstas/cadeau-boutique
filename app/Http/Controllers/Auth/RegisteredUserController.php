<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationOtp;
use App\Models\User;
use App\Models\UserOtps;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    public function store(Request $req): JsonResponse
    {
        $req->validate([
            "name" => ["required", "string", "max:255"],
            "gender" => ["string"],
            "phoneNumber" => ["required", "string"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required", "confirmed", "min:8"],
        ]);

        $user = User::create([
            "name" => $req->input("name"),
            "gender" => $req->input("gender"),
            "phone_number" => $req->input("phoneNumber"),
            "email" => $req->input("email"),
            "password" => Hash::make($req->input("password")),
        ]);


        $otp = rand(100000, 999999);

        UserOtps::create([
            "user_id" => $user->id,
            "otp" => $otp,
            "expires_at" => now()->addMinutes(20),
        ]);

        Mail::to($user->email)->send(new VerificationOtp($otp));

        return response()->json([
            "status" => true,
            "data" => [
                "user" => [
                    "userId" => $user->id,
                    "userName" => $user->name,
                    "userGender" => $user->gender,
                    "userPhoneNumber" => $user->phone_number,
                    "userEmail" => $user->email,
                ],
            ],
            "message" => "User has been created",
            "code" => 200
        ], 200);
    }
}
