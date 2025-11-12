<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                "name" => "Raffoul",
                "description" => "Cakes and chocolate",
                "logo" => null,
            ],
            [
                "name" => "Nahhas",
                "description" => "Cakes and chocolate",
                "logo" => null,
            ],
            [
                "name" => "Al-Mahabe",
                "description" => "Flower bouquets and decorations",
                "logo" => null,
            ],
            [
                "name" => "Ugarit Flowers",
                "description" => "Flower bouquets and decorations",
                "logo" => null,
            ],
            [
                "name" => "Apple",
                "description" => "Technology products",
                "logo" => null,
            ],
            [
                "name" => "Samsung",
                "description" => "Technology & home products",
                "logo" => null,
            ],
            [
                "name" => "Nike",
                "description" => "Sports shoes and clothing",
                "logo" => null,
            ],
            [
                "name" => "Adidas",
                "description" => "Sports shoes and clothing",
                "logo" => null,
            ],
            [
                "name" => "Sony",
                "description" => "Technology & entertaiments",
                "logo" => null,
            ],
            [
                "name" => "Zara",
                "description" => "Fashion clothing and accessories",
                "logo" => null,
            ],
            [
                "name" => "Pandora",
                "description" => "Charm bracelets and jewelry",
                "logo" => null,
            ],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
