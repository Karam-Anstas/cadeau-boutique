<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Occasion;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cakes = Category::where("name", "Cakes")->first();
        $flowers = Category::where("name", "Flowers")->first();
        $phones = Category::where("name", "Smartphones & Tablets")->first();
        $menClothing = Category::where("name", "Men's Clothing")->first();

        $raffoul = Brand::where("name", "Raffoul")->first();
        $nahhas = Brand::where("name", "Nahhas")->first();
        $alMahabe = Brand::where("name", "Al-Mahabe")->first();
        $apple = Brand::where("name", "Apple")->first();
        $zara = Brand::where("name", "Zara")->first();

        $birthday = Occasion::where("name", "Birthday")->first();
        $mothersday = Occasion::where("name", "Mother's day")->first();
        $fathersday = Occasion::where("name", "Father's day")->first();
        $christmas = Occasion::where("name", "Christmas")->first();

        $raffoulCakes = Product::create([
            "name" => "Chocolate Cake.",
            "description" => "Premium chocolate cake from Raffoul with rich galaxy chocolate layers and creamy frosting.",
            "price" => 10.99,
            "product_quantity" => 4,
            "in_stock" => true,
            "features" => "Galaxy chocolate flavor, with size of 22cm",
            "has_variants" => true,
            "variants" => collect([
                [
                    "id" => "var1",
                    "price" => 7.99,
                    "product_quantity" => 1,
                    "in_stock" => true,
                    "features" => collect(["size" => "17cm", "decoration" => "standerd"])
                ],
                [
                    "id" => "var2",
                    "price" => 10.99,
                    "product_quantity" => 3,
                    "in_stock" => true,
                    "attributes" => collect(["size" => "22cm", "decoration" => "fresh fruit"])
                ],
                [
                    "id" => "var3",
                    "price" => 15.99,
                    "product_quantity" => 0,
                    "in_stock" => false,
                    "attributes" => collect(["size" => "30cm", "decoration" => "nuts"])
                ],
            ]),
            "category_id" => $cakes->id,
            "brand_id" => $raffoul->id
        ]);

        $raffoulCakes->occasions()->attach([$birthday->id, $christmas->id]);

        $menPresnt1 = Product::create([
            "name" => "Chocolate Cake.",
            "description" => "Premium chocolate cake from Raffoul with rich galaxy chocolate layers and creamy frosting.",
            "price" => 10.99,
            "product_quantity" => 4,
            "in_stock" => true,
            "features" => "Galaxy chocolate flavor, with size of 22cm",
            "has_variants" => true,
            "variants" => collect([
                [
                    "id" => "var1",
                    "price" => 7.99,
                    "product_quantity" => 1,
                    "in_stock" => true,
                    "features" => collect(["size" => "17cm", "decoration" => "standerd"])
                ],
                [
                    "id" => "var2",
                    "price" => 10.99,
                    "product_quantity" => 3,
                    "in_stock" => true,
                    "attributes" => collect(["size" => "22cm", "decoration" => "fresh fruit"])
                ],
                [
                    "id" => "var3",
                    "price" => 15.99,
                    "product_quantity" => 0,
                    "in_stock" => false,
                    "attributes" => collect(["size" => "30cm", "decoration" => "nuts"])
                ],
            ]),
            "category_id" => $cakes->id,
            "brand_id" => $raffoul->id
        ]);

        $raffoulCakes->occasions()->attach([$birthday->id, $christmas->id]);

        $nahhasCake = Product::create([
            "name" => "Nahhas Celebration Cake",
            "description" => "Elegant celebration cake from Nahhas with multiple flavor options and beautiful decorations. A perfect centerpiece for any party.",
            "price" => 65.00,
            "product_quantity" => 6,
            "in_stock" => true,
            "features" => "Many flavors, many sizes, customizable designs",
            "has_variants" => true,
            "variants" => collect([
                [
                    "id" => "var1",
                    "price" => 65.00,
                    "product_quantity" => 3,
                    "in_stock" => true,
                    "attributes" => collect(["flavor" => "Vanilla", "filling" => "Buttercream"])
                ],
                [
                    "id" => "var2",
                    "price" => 70.00,
                    "product_quantity" => 2,
                    "in_stock" => true,
                    "attributes" => collect(["flavor" => "Chocolate", "filling" => "Chocolate ganache"])
                ],
                [
                    "id" => "var3",
                    "price" => 75.00,
                    "product_quantity" => 1,
                    "in_stock" => true,
                    "attributes" => collect(["flavor" => "Red Velvet", "filling" => "Buttercream"])
                ]
            ]),
            'category_id' => $cakes->id,
            'brand_id' => $nahhas->id
        ]);

        $nahhasCake->occasions()->attach([$birthday->id, $mothersday->id, $christmas->id]);

        // Product 3: Al-Mahabe Flower Bouquet
        $alMahabeFlowers = Product::create([
            "name" => "Al-Mahabe Premium Rose Bouquet",
            "description" => "Exquisite rose bouquet from Al-Mahabe featuring the finest imported roses, expertly arranged for maximum impact and longevity.",
            "price" => 80.00,
            "product_quantity" => 14,
            "in_stock" => false,
            "features" => "Premium Imported Roses, 15 stems",
            "has_variants" => true,
            "variants" => collect([
                [
                    "id" => "var1",
                    "price" => 80.00,
                    "product_quantity" => 8,
                    "in_stock" => true,
                    "attributes" => collect(["color" => "Red", "style" => "Classic"])
                ],
                [
                    "id" => "var2",
                    "price" => 85.00,
                    "product_quantity" => 6,
                    "in_stock" => true,
                    "attributes" => collect(["color" => "Pink", "style" => "Modern"])
                ],
            ]),
            "category_id" => $flowers->id,
            "brand_id" => $alMahabe->id
        ]);

        $alMahabeFlowers->occasions()->attach([$mothersday->id, $birthday->id, $christmas->id]);

        $alMahabeFlowers = Product::create([
            "name" => "Rose Bouquet",
            "description" => "Fancy rose bouquets from Al-Mahabe flowers",
            "price" => 5.50,
            "product_quantity" => 10,
            "in_stock" => true,
            "features" => "This bouquet has 15 flower, it includes card and the lifespan between 10-12 days.",
            "has_variants" => false,
            "category_id" => $flowers->id,
            "brand_id" => $alMahabe->id
        ]);

        $alMahabeFlowers->occasions()->attach([$mothersday->id, $birthday->id, $christmas->id]);
    }
}
