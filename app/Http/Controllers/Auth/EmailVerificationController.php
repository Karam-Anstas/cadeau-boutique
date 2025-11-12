<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserOtps;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verifyOtp(Request $req): JsonResponse
    {

        $req->validate([
            "userId" => ["required", "exists:users,id"],
            "otp" => ["required", "string"]
        ]);

        $otpReq = UserOtps::where("user_id", $req->userId)
            ->where("otp", $req->otp)
            ->where("expires_at", ">", now())
            ->first();

        $user = User::find($req->userId);

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                "status" => true,
                "data" => [
                    "dateOfVerify" => $user->email_verified_at, 
                ],
                "message" => "Email already verified.",
                "code" => 202
            ], 202);
        }

        if (!$otpReq) {
            return response()->json([
                "status" => false,
                "message" => "Invalid or expired code",
                "code" => 400,
            ], 400);
        }


        $user->email_verified_at = now();
        $user->save();

        $otpReq->delete();

        return response()->json([
            "status" => true,
            "data" => [
                "dateOfVerify" => $user->email_verified_at, 
            ],
            "message" => "Email verified successfully",
            "code" => 200
        ], 200);
    }
}
