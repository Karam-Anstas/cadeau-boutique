<?php

use App\Models\Occasion;
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
        Schema::create("occasion_product", function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Occasion::class)->constrained("occasions")->onDelete("cascade");
            $table->foreignIdFor(Product::class)->constrained("products")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("occasion_product");
    }
};
