<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpParser\Node\Stmt\Catch_;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $cakes = Category::create([
            "name" => "Cakes",
            "description" => "Find some delicious cakes for any occasion",
            "image" => null,
        ]);

        $flowers = Category::create([
            "name" => "Flowers",
            "description" => "Gift flower bouquets in any occasion",
            "image" => null,
        ]);

        $electronics = Category::create([
            "name" => "Electronics",
            "description" => "Latest electronic gadgets and devices",
            "image" => null,
        ]);

        $home = Category::create([
            "name" => "Home & Living",
            "description" => "Home decor and living essentials",
            "image" => null,
        ]);

        $toys = Category::create([
            "name" => "Toys & Games",
            "description" => "Fun toys and games for all ages",
            "image" => null,
        ]);

        $jewelry  = Category::create([
            "name" => "Jewelry & Watches",
            "description" => "Beautiful jewelry and watches",
            "image" => null,
        ]);

        $clothes  = Category::create([
            "name" => "Clothes",
            "description" => "Find what you need for looking good",
            "image" => null,
        ]);

        Category::create([
            "name" => "Smartphones & Tablets",
            "description" => "Find your need from smartphones, tablets and accessories",
            "image" => null,
            "parent_id" => $electronics->id,
        ]);

        Category::create([
            "name" => "Laptops & pc's",
            "description" => "Boost your daylie work with the best laptops for you",
            "image" => null,
            "parent_id" => $electronics->id,
        ]);

        Category::create([
            "name" => "Smartwatches",
            "description" => "smartwatches for tracking your health",
            "image" => null,
            "parent_id" => $electronics->id,
        ]);

        Category::create([
            "name" => "Smartwatches",
            "description" => "smartwatches for tracking your health",
            "image" => null,
            "parent_id" => $electronics->id,
        ]);

        Category::create([
            "name" => "Men's Clothing",
            "description" => "Clothing for men",
            "image" => null,
            "parent_id" => $clothes->id,
        ]);

        Category::create([
            "name" => "Women's Clothing",
            "description" => "Clothing for women",
            "image" => null,
            "parent_id" => $clothes->id,
        ]);

        Category::create([
            "name" => "Shoes",
            "description" => "Footwear for all occasions",
            "image" => null,
            "parent_id" => $clothes->id,
        ]);

        Category::create([
            "name" => "Bags & Luggage",
            "description" => "Bags, purses, and luggage",
            "image" => null,
            "parent_id" => $clothes->id,
        ]);

        Category::create([
            "name" => "Home Decor",
            "description" => "Home decoration items",
            "image" => null,
            "parent_id" => $home->id,
        ]);

        Category::create([
            "name" => "Kitchenware",
            "description" => "Kitchen utensils and appliances",
            "image" => null,
            "parent_id" => $home->id,
        ]);

        Category::create([
            "name" => "Furniture",
            "description" => "Home and office furniture",
            "image" => null,
            "parent_id" => $home->id,
        ]);

        Category::create([
            "name" => "Bed & Bath",
            "description" => "Bedding and bathroom essentials",
            "image" => null,
            "parent_id" => $home->id,
        ]);

        Category::create([
            "name" => "Garden & Outdoor",
            "description" => "Outdoor and garden items",
            "image" => null,
            "parent_id" => $home->id,
        ]);

        Category::create([
            "name" => "Necklaces",
            "description" => "Beautiful necklaces and pendants",
            "image" => null,
            "parent_id" => $jewelry->id,
        ]);

        Category::create([
            "name" => "Rings",
            "description" => "Elegant rings for all occasions",
            "image" => null,
            "parent_id" => $jewelry->id,
        ]);

        Category::create([
            "name" => "Bracelets",
            "description" => "Stylish bracelets and bangles",
            "image" => null,
            "parent_id" => $jewelry->id,
        ]);

        Category::create([
            "name" => "Watches",
            "description" => "Luxury and casual watches",
            "image" => null,
            "parent_id" => $jewelry->id,
        ]);

        Category::create([
            "name" => "Earrings",
            "description" => "Beautiful earrings and studs",
            "image" => null,
            "parent_id" => $jewelry->id,
        ]);
    }
}
