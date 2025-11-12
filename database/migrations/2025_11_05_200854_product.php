<?php

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("products", function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained("categories")->onDelete("cascade");
            $table->foreignIdFor(Brand::class)->constrained("brands")->onDelete("cascade");
            $table->string("name");
            $table->text("description");
            $table->decimal("price", 10, 2);
            $table->integer("product_quantity")->default(0);
            $table->text("features")->nullable();
            $table->boolean("in_stock")->default(false);
            $table->boolean("has_variants")->default(false);
            $table->json("variants")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("product");
    }
};
