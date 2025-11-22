<?php

use App\Http\Controllers\Auth\{
    EmailVerificationController,
    GoogleAuthController,
    PasswordResetController,
    RegisteredUserController,
    SessionController,
};
use App\Http\Controllers\{
    BrandController,
    CategoryController,
    OccasionController,
    VendorController,
};
use App\Http\Controllers\Admin\AdminVendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware("guest:sanctum")->group(function () {

    Route::post("/register", [RegisteredUserController::class, "store"])->name("register");

    Route::post("/login", [SessionController::class, "store"])
        ->name("login");

    Route::post("/send-reset-code", [PasswordResetController::class, "sendResetOtp"])->name("password.reset");

    Route::post("/reset-password", [PasswordResetController::class, "resetPassword"])->name("password.store");

    Route::get("/auth/google/redirect", [GoogleAuthController::class, "redirect"]);

    Route::get("/auth/google/callback", [GoogleAuthController::class, "callback"]);
});

Route::middleware("auth:sanctum")->group(function () {

    Route::delete("/logout", [SessionController::class, "destroy"])
        ->name("logout");

    Route::post("/email-verification", [EmailVerificationController::class, "verifyOtp"])->name("email.verification");
});

Route::get("/brands", [BrandController::class, "index"])->name("getAllBrands");
Route::get("/brands/{id}", [BrandController::class, "show"])->name("getBrand");
Route::get("/occasions", [OccasionController::class, "index"])->name("getOccasions");
Route::get("/occasions/{id}", [OccasionController::class, "show"])->name("getOccasion");
Route::get("/categories", [CategoryController::class, "index"])->name("getCategories");
Route::get("/categories/{id}", [CategoryController::class, "show"])->name("getCategory");

Route::post("/vendor/apply", [VendorController::class, "apply"])->middleware("auth:sanctum");

Route::get("/admin/vendors/pending", [AdminVendorController::class, "pendingVendors"]);

Route::post("/admin/vendors/{vendorId}/approve", [AdminVendorController::class, "approve"]);

// Reject vendor
Route::post("/admin/vendors/{vendorId}/reject", [AdminVendorController::class, "reject"]);
