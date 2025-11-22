<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\VendorApprovedMail;
use App\Mail\VendorRejectedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminVendorController extends Controller
{
    public function pendingVendors()
    {
        $vendors = DB::table("vendors")->select("*")->where("status", "=", "pending")->get();

        return response()->json([
            "status" => true,
            "data" => [
                "vendors" => $vendors,
            ],
            "message" => "all pending vendors",
            "code" => 200,
        ], 200);
    }

    public function approve($vendorId)
    {
        $vendor = DB::table("vendors")->where("id", "=", $vendorId)->first();
        $user = DB::table("users")->where("vendor_id", "=", $vendorId)->first();

        if (!$vendor) {
            return response()->json([
                "status" => false,
                "data" => [],
                "message" => "vendore not found",
                "code" => 404,
            ], 404);
        }

        DB::table("vendors")->where("id", "=", $vendorId)->update([
            "status" => "approved",
            "updated_at" => now(),
        ]);

        Mail::to($user->email)->send(new VendorApprovedMail($user, $vendor));

        return response()->json([
            "status" => true,
            "data" => [
                "vendor" => $vendor,
            ],
            "message" => "vendor approved successfully",
            "code" => 200
        ], 200);
    }

    public function reject($vendorId)
    {
        $vendor = DB::table("vendors")->where("id", "=", $vendorId)->first();
        $user = DB::table("users")->where("vendor_id", "=", $vendorId)->first();

        if (!$vendor) {
            return response()->json([
                "status" => false,
                "data" => [],
                "message" => "vendore not found",
                "code" => 404,
            ], 404);
        }

        DB::table("vendors")->where("id", "=", $vendorId)->update([
            "status" => "rejected",
            "updated_at" => now(),
        ]);

        Mail::to($user->email)->send(new VendorRejectedMail($user, $vendor));

        return response()->json([
            "status" => true,
            "data" => [],
            "message" => "vendor rejected",
            "code" => 200
        ], 200);
    }
}
