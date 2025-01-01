<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// frontend routes
Route::controller(IndexController::class)->group(function () {
  Route::get('/', 'index')->name('welcome');
  Route::prefix('account')->middleware(['auth'])->name('account.')->group(function () {
    Route::get("/{username}", 'accountDetails')->name('details');
    Route::get('edit/{username}', 'accountEdit')->name('edit');
    Route::put('edit/{username}', 'accountUpdate')->name('update');
    Route::get('orders/{username}', 'accountOrders')->name('orders');
    Route::get('address/{username}', 'accountAddress')->name('address');
    Route::post('address/billing', 'billingAddress')->name('billing.address');
    Route::post('address/shipping', 'shippingAddress')->name('shipping.address');
  });

  //show category
  Route::prefix('category')->group(function () {
    Route::get('/{slug}', 'categoryProduct')->name('category.product');
  });

  //show product
  Route::prefix('product')->group(function () {
    Route::get('/details/{slug}', 'productDetails')->name('product.details');
  });
});

// cart routes
Route::prefix('cart')->name('cart.')->controller(CartController::class)->group(function () {
  Route::post('/store', 'store')->name('store');
  // exists cart
  Route::middleware('cart')->group(function () {
    Route::get('/', 'index')->name('index');
    // remove item from cart table
    Route::post('/table/destroy', 'tableDestroy')->name('table.destroy');
    Route::post('/remove', 'remove')->name('remove');
    Route::post('/update', 'update')->name('update');
    Route::post('coupon', 'coupon')->name('coupon');
  });
});

// wishlist routes
Route::prefix('wishlist')->name('wishlist.')->controller(WishlistController::class)->group(function () {
  Route::post('/store', 'store')->name('store');
  // exists cart
  Route::middleware('wishlist')->group(function () {
    Route::get('/', 'index')->name('index');
    // remove item from cart table
    Route::post('/table/destroy', 'tableDestroy')->name('table.destroy');
    Route::post('add-to-cart', 'addToCart')->name('add-to-cart');
    Route::get('add-all-item', 'addAllItem')->name('add-all-item');
  });
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes
require __DIR__ . '/auth.php';

//admin routes
Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
  Route::view('/', 'backend.index')->name('admin');

  //Banner section
  Route::resource('banner', BannerController::class);
  Route::post('banner/status/update', [BannerController::class, 'statusUpdate'])->name('status.update');

  //Category section
  Route::resource('category', CategoryController::class);
  Route::post('category/status/update', [CategoryController::class, 'categoryUpdate'])->name('category_status.update');

  //Brand Section
  Route::resource('brand', BrandController::class);
  Route::post('brand/status/update', [BrandController::class, 'brandUpdate'])->name('brand_status.update');

  //Brand Section
  Route::resource('product', ProductController::class);
  Route::post('product/status/update', [ProductController::class, 'productStatusUpdate'])->name('product_status.update');

  //User Section
  Route::resource('user', UserController::class);
  Route::post('user/status/update', [UserController::class, 'userStatusUpdate'])->name('user_status.update');

  //Coupon Section
  Route::resource('coupon', CouponController::class);
  Route::post('coupon/status/update', [CouponController::class, 'couponStatusUpdate'])->name('coupon_status.update');
});

//vendor routes
Route::prefix('vendor')->middleware(['auth', 'verified', 'role:vendor'])->group(function () {
  Route::view('/', 'vendor.index')->name('vendor');
});

//customer routes
Route::prefix('customer')->middleware(['auth', 'verified', 'role:customer'])->group(function () {
  Route::view('/', 'customer.index')->name('customer');
});