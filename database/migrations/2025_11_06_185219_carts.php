<?php

use App\Models\User;
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
        Schema::create("carts", function (Blueprint $table) {
            $table->id();
            $table->foreignId(User::class)->constrained("users")->onDelete("cascade");
            $table->decimal("subtotal", 10, 2)->default(0);
            $table->decimal("tax_amount", 10, 2)->default(0);
            $table->decimal("shipping_amount", 10, 2)->default(0);
            $table->decimal("total", 10, 2)->default(0);
            $table->integer("items_count")->default(0);
            $table->timestamps();

            $table->unique([User::class]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("carts");
    }
};
