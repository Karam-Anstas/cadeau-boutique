<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetOtp;
use App\Models\User;
use App\Models\UserOtps;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PasswordResetController extends Controller
{
    public function sendResetOtp(Request $req): JsonResponse
    {

        $validator = Validator::make($req->all(), [
            "email" => ["required", "email", "exists:users,email"],
        ]);

        if ($validator->fails()) {
            $messages = implode("\n", $validator->errors()->all());

            return response()->json([
                "status" => false,
                "data" => null,
                "message" => $messages,
                "code" => 422
            ], 422);
        }

        $user = User::where("email", $req->email)->first();

        if (!$user) return response()->json([
            "status" => false,
            "data" => null,
            "message" => "User not found",
            "code" => 404,
        ], 404);

        $otp = rand(100000, 999999);
        $expiresAt = now()->addMinutes(20);

        UserOtps::where("user_id", $user->id)->delete();

        UserOtps::create([
            "user_id" => $user->id,
            "otp" => $otp,
            "expires_at" => $expiresAt
        ]);

        Mail::to($user->email)->send(new PasswordResetOtp($otp));

        return response()->json([
            "status" => true,
            "message" => "Reset code sent to your email",
            "code" => 200,
        ], 200);
    }

    public function resetPassword(Request $req): JsonResponse
    {

        $validator = Validator::make($req->all(), [
            "userId" => ["required", "exists:users,id"],
            "otp" => ["required", "string"],
            "password" => ["required", "confirmed", "min:8"],
        ]);


        if ($validator->fails()) {
            $messages = implode("\n", $validator->errors()->all());

            return response()->json([
                "status" => false,
                "data" => null,
                "message" => $messages,
                "code" => 422
            ], 422);
        }

        $otpReq = UserOtps::where("user_id", $req->userId)
            ->where("otp", $req->otp)
            ->where("expires_at", ">", now())
            ->first();

        if (!$otpReq) {
            return response()->json([
                "status" => false,
                "data" => null,
                "message" => "Invalid or expired OTP.",
                "code" => 400
            ], 400);
        }

        $user = User::find($req->userId);
        $user->password = Hash::make($req->password);
        $user->save();

        $otpReq->delete();

        return response()->json([
            "status" => true,
            "message" => "Password reset successfully",
            "code" => 200,
        ], 200);
    }
}
