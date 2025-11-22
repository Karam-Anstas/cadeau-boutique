<?php

use App\Models\Vendor;
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
        Schema::create("vendors", function (Blueprint $table) {
            $table->id();
            $table->string("shop_name");
            $table->text("description")->nullable();
            $table->string("logo")->nullable();
            $table->string("phone_number")->nullable()->unique();
            $table->string("country")->nullable();
            $table->string("city")->nullable();
            $table->text("address")->nullable();
            $table->enum("status", ["pending", "approved", "rejected"])->default("pending");
            $table->timestamps();
        });

        Schema::table("users", function (Blueprint $table) {
            $table->foreignIdFor(Vendor::class)->nullable()->constrained()->onDelete("set null");
        });

        Schema::table("products", function (Blueprint $table) {
            $table->foreignIdFor(Vendor::class)->nullable()->constrained()->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("vendors");
    }
};
