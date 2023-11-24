<?php

use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ColorsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ProductVariantsController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Customer\AccountController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\HomeController;
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
Route::get("/products", [\App\Http\Controllers\Customer\ProductsController::class, 'products'])->name('products');
Route::get("/products/sales", [\App\Http\Controllers\Customer\ProductsController::class, 'sales'])->name('products.sales');
Route::get("/products/related", [\App\Http\Controllers\Customer\ProductsController::class, 'relatedProducts'])->name('products.related');
Route::get("/products/{slug}", [\App\Http\Controllers\Customer\ProductsController::class, 'productDetail'])->name('product.detail');
Route::get("/category/{slug}", [\App\Http\Controllers\Customer\CategoriesController::class, 'category'])->name('category');

Route::get("/search", [\App\Http\Controllers\Customer\ProductsController::class, 'search'])->name('search');

Route::get("/cart", [\App\Http\Controllers\Customer\CartController::class, 'cart'])->name('cart');

Route::post("/checkout", [CheckoutController::class, 'checkout'])->name('checkout');
Route::get("/checkout/success", [CheckoutController::class, 'success'])->name('checkout.success');


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

    // Google login route
    Route::get('/google', [GoogleLoginController::class, 'google'])->name('auth.google');
    Route::get('/google/redirect', [GoogleLoginController::class, 'redirect'])->name('auth.google.redirect');
});


// Admin routes
Route::prefix('admin')->middleware(["auth", "role:ADMIN,STAFF,null"])->group(function () {
    Route::get("/dashboard", [DashboardController::class, 'dashboard'])->name("admin.dashboard");

    Route::post("/products/images", [ProductsController::class, 'updateImages'])->name("admin.products.images.update");
    Route::resource('products', ProductsController::class, ['as' => 'admin']);
    
    Route::get("/products/{id}/variants", [ProductVariantsController::class, 'show'])->name("admin.products.variants");
    Route::post("/products/variants", [ProductVariantsController::class, 'create'])->name("admin.products.variants.store");
    Route::patch("/products/variants/{id}/quantity", [ProductVariantsController::class, 'updateQuantity'])->name("admin.products.variants.quantity.update");
    Route::delete("/products/variants/{id}", [ProductVariantsController::class, 'destroy'])->name("admin.products.variants.destroy");

    Route::resource('categories', CategoriesController::class, ['as' => 'admin']);
    
    Route::resource('colors', ColorsController::class, ['as' => 'admin']);

    Route::resource('banners', BannersController::class, ['as' => 'admin'])->middleware(['role:ADMIN,null,null']);

    Route::get("/orders", [\App\Http\Controllers\Admin\OrdersController::class, 'index'])->name('admin.orders.index');
    Route::get("/orders/{code}", [\App\Http\Controllers\Admin\OrdersController::class, 'show'])->name('admin.orders.show');
    Route::patch("/orders/{code}", [\App\Http\Controllers\Admin\OrdersController::class, 'update'])->name('admin.orders.update');
});


// Account routes
Route::prefix('account')->middleware(["auth"])->group(function () {
    Route::get("/infor", [AccountController::class, "infor"])->name("account.infor");
    Route::get("/password", [AccountController::class, "password"])->name("account.password");
    Route::get("/orders", [\App\Http\Controllers\Customer\OrdersController::class, "orders"])->name("account.orders");
    Route::get("/orders/{code}", [\App\Http\Controllers\Customer\OrdersController::class, "detail"])->name("account.orders.detail");
    Route::patch("/orders/{code}", [\App\Http\Controllers\Customer\OrdersController::class, "cancel"])->name("account.orders.cancel");
});
