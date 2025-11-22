<?php

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Attributes\Scope;
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
        Schema::create("wishlist_items", function (Blueprint $table) {
            $table->id();
            $table->foreignId(Wishlist::class)->constrained("wishlists")->onDelete("cascade");
            $table->foreignId(Product::class)->constrained("products")->onDelete("cascade");
            $table->timestamps();

            $table->unique([Wishlist::class, Product::class]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("wishlist_items");
    }
};
