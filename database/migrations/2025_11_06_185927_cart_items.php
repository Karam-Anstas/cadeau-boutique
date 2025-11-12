<?php

use App\Models\Cart;
use App\Models\Product;
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
        Schema::create("cart_items", function (Blueprint $table) {
            $table->id();
            $table->foreignId(Cart::class)->constrained("carts")->onDelete("cascade");
            $table->foreignId(Product::class)->constrained("products")->onDelete("cascade");
            $table->integer("quantity")->default(0);
            $table->decimal("unit_price", 10, 2);
            $table->decimal("total", 10, 2);
            $table->json("variant_attributes")->nullable();
            $table->timestamps();

            $table->unique([Cart::class, Product::class]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("cart_items");
    }
};
