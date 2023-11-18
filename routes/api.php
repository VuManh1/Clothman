<?php

use App\Http\Controllers\Api\AccountApiController;
use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\Api\ColorsApiController;
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

// Account API
Route::prefix('account')->middleware(["auth"])->group(function () {
    Route::put("/infor", [AccountApiController::class, "updateInfor"])->name("api.account.infor.update");
    Route::patch("/password", [AccountApiController::class, "changePassword"])->name("api.account.password.update");
});

// Cart API
Route::get("/cart/count", [CartApiController::class, 'count'])->name('api.cart.count');
Route::post("/cart", [CartApiController::class, 'addToCart'])->name('api.cart.store');
Route::patch("/cart", [CartApiController::class, 'updateCart'])->name('api.cart.update');
Route::delete("/cart", [CartApiController::class, 'removeCart'])->name('api.cart.destroy');

// Colors API
Route::get("/colors", [ColorsApiController::class, 'getColors'])->name('api.colors');
