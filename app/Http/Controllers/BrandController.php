<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = DB::table("brands")->select("id", "name", "logo", "description")->get();

        return response()->json([
            "status" => true,
            "data" =>
            BrandResource::collection($brands),
            "code" => 200
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(String $id)
    {
        $brand = DB::table("brands")->select("id", "name", "logo", "description")->where("id", "=", $id)->first();

        $products = DB::table("products")->select("id", "name", "description", "price", "product_quantity", "features")->where("brand_id", "=", $id)->get();

        return response()->json([
            "status" => true,
            "data" => [
                "brand" => new BrandResource($brand),
                "products" => $products->map(function ($product) {
                    return [
                        "productId" => $product->id,
                        "productName" => $product->name,
                        "productDescription" => $product->description,
                        "productPrice" => $product->price,
                        "productQuantity" => $product->product_quantity,
                        "productFeatures" => $product->features,
                    ];
                })
            ],
            "code" => 200
        ], 200);
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
