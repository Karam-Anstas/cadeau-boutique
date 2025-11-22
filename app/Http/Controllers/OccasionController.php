<?php

namespace App\Http\Controllers;

use App\Http\Resources\OccasionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OccasionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $occasions = DB::table("occasions")->select("id", "name", "image", "description")->get();

        return response()->json([
            "status" => true,
            "data" => OccasionResource::collection($occasions),
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
    public function show(string $id)
    {
        $occasion = DB::table("occasions")->select("id", "name", "image", "description")->where("id", "=", $id)->first();

        $products = DB::table("occasion_product")
            ->select("products.id", "products.name", "products.description", "products.price", "products.product_quantity", "products.features", "products.in_stock")
            ->join("products", "occasion_product.product_id", "=", "products.id")
            ->where("occasion_product.occasion_id", "=", $id)->get();

        return response()->json([
            "status" => true,
            "data" => [
                "occasion" => new OccasionResource($occasion),
                "products" => $products->map(function ($product) {
                    return [
                        "productId" => $product->id,
                        "productName" => $product->name,
                        "productDescription" => $product->description,
                        "productPrice" => $product->price,
                        "productQuantity" => $product->product_quantity,
                        "productFeatures" => $product->features,
                        "productInStock" => $product->in_stock
                    ];
                })
            ],
            "code" =>200
        ]);
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
