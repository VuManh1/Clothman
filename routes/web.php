<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ColorsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
* Client routes
*/
Route::get("/", [HomeController::class, 'index'])->name('home');
Route::get("/products/{slug}", [HomeController::class, 'productDetail'])->name('product.detail');

/*
* Auth routes
*/
Route::prefix('auth')->group(function () {
    // Login route
    Route::get('/login', [LoginController::class, 'login'])->name("login");
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::post('/logout', [LoginController::class, 'logout'])->name("logout");

    // Register route
    Route::get('/register', [RegisterController::class, 'register'])->name("register");
    Route::post('/register', [RegisterController::class, 'store']);

    // Email confirmation route
    Route::get("/email/verify", [EmailVerificationController::class, "notice"])->middleware("auth")->name("verification.notice");
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, "verify"])
        ->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationController::class, "send"])
        ->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    // Forgot password route
    Route::get('/forgot-password', [ForgotPasswordController::class, "request"])->middleware('guest')->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, "email"])->middleware('guest')->name('password.email');

    // Reset password route
    Route::get('/reset-password/{token}', [ResetPasswordController::class, "reset"])->middleware('guest')->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, "update"])->middleware('guest')->name('password.update');
});

// Admin routes
Route::prefix('admin')->middleware(["auth", "role:ADMIN,STAFF,null"])->group(function () {
    Route::get("/dashboard", [DashboardController::class, 'dashboard'])->name("admin.dashboard");

    Route::resource('products', ProductsController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('colors', ColorsController::class);

});

// Account routes
Route::prefix('account')->middleware(["auth"])->group(function () {
    Route::get("/infor", [AccountController::class, "infor"])->name("account.infor");
    Route::get("/password", [AccountController::class, "password"])->name("account.password");
});