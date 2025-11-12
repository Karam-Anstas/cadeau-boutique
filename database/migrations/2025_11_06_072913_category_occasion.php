<?php

use App\Models\Category;
use App\Models\Occasion;
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
        Schema::create("category_occasion", function (Blueprint $table) {
            $table->id();
            $table->foreignId(Category::class)->constrained("categories")->onDelete("cascade");
            $table->foreignId(Occasion::class)->constrained("occasions")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("category_occasion");
    }
};
