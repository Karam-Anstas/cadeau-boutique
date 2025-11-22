<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DB::table("categories")->select("id", "name", "image", "description")->get();

        return response()->json([
            "status" => true,
            "data" => CategoryResource::collection($categories),
            "code" => 200,
        ]);
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
        $category = DB::table("categories")->select("id", "name", "image", "description", "parent_id")->where("id", "=", $id)->first();
        $subCategories = DB::table("categories")->select("id", "name", "image", "description", "parent_id")->where("parent_id", "=", $id)->get();

        $products = DB::table("products")->select("id", "name", "description", "price", "product_quantity", "features", "category_id", "brand_id")->where("category_id", "=", $id)->get();

        return response()->json([
            "status" => true,
            "data" => [
                "category" => new CategoryResource($category),
                "subcategories" => CategoryResource::collection($subCategories),
                "products" => $products->map(function ($product) {
                    return [
                        "productId" => $product->id,
                        "productName" => $product->name,
                        "productDescription" => $product->description,
                        "productPrice" => $product->price,
                        "productQuantity" => $product->product_quantity,
                        "productFeatures" => $product->features,
                        "categoryId" => $product->category_id,
                        "brandId" => $product->brand_id,
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
