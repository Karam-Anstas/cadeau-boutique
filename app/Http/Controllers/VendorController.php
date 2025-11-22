<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendorResource;
use App\Mail\VendorAppliedMail;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = DB::table("vendors")
            ->select("id", "shop_name", "description", "logo")
            ->where("status", "=", "approved")->paginate(5)->get();

        return response()->json([
            "status" => true,
            "data" => VendorResource::collection($vendors),
            "code" => 200
        ], 200);
    }

    public function apply(Request $req)
    {
        $req->validate([
            "shopName" => ["required", "string", "max:255"],
            "phoneNumber" => ["required", "string", "unique:vendors,phone_number"],
            "shopDescription" => ["nullable", "string"],
            "country" => ["required", "string"],
            "city" => ["required", "string"],
            "address" => ["required", "string"],
        ]);

        $vendor = Vendor::create([
            "shop_name" => $req->shopName,
            "phone_number" => $req->phoneNumber,
            "description" => $req->shopDescription,
            "country" => $req->country,
            "city" => $req->city,
            "address" => $req->address,
            "status" => "pending",
        ]);

        $req->user()->update([
            "account_type" => "vendor",
            "vendor_id" => $vendor->id,
        ]);

        Mail::to($req->user()->email)->send(new VendorAppliedMail($req->user(), $vendor));

        return response()->json([
            "message" => "Vendor application submitted. Waiting for admin approval.",
            "vendor" => [
                "shopName" => $vendor->shop_name,
                "phoneNumber" =>  $vendor->phone_number,
                "description" =>  $vendor->description,
                "country" => $vendor->country,
                "city" => $vendor->city,
                "address" => $vendor->address
            ]
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
