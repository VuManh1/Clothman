<?php

use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\Api\ColorsApiController;
use App\Http\Controllers\Api\DashboardApiController;
use App\Http\Controllers\Api\MeApiController;
use App\Http\Controllers\Api\ProductsApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Me API
Route::prefix('me')->middleware(["auth"])->group(function () {
    Route::put("/infor", [MeApiController::class, "updateInfor"])->name("api.me.infor.update");
    Route::patch("/password", [MeApiController::class, "changePassword"])->name("api.me.password.update");

    Route::get("/orders", [MeApiController::class, "getOrders"])->name("api.me.orders");
});

// Cart API
Route::get("/cart/count", [CartApiController::class, 'count'])->name('api.cart.count');
Route::post("/cart", [CartApiController::class, 'addToCart'])->name('api.cart.store');
Route::patch("/cart", [CartApiController::class, 'updateCart'])->name('api.cart.update');
Route::delete("/cart", [CartApiController::class, 'removeCart'])->name('api.cart.destroy');

// Colors API
Route::get("/colors", [ColorsApiController::class, 'getColors'])->name('api.colors');

// Products API
Route::get("/products", [ProductsApiController::class, 'getProducts'])->name('api.products');
Route::get("/products/top-selling", [ProductsApiController::class, 'getTopSelling'])->name('api.products.topselling');

// Admin dashboard
Route::get("/get-dashboard", [DashboardApiController::class, 'getDashboard'])
    ->middleware(["auth", "role:ADMIN,STAFF,null"])->name('api.dashboard');
Route::get("/dashboard/year-stats", [DashboardApiController::class, 'getYearStats'])
    ->middleware(["auth", "role:ADMIN,STAFF,null"])->name('api.dashboard.yearstats');
