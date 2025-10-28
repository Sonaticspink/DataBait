<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/dashboard', function () {
//     return view('dashboard'); // create a simple view for testing
// })->middleware('auth');
// require __DIR__.'/settings.php';

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');
    require __DIR__.'/settings.php';

// Store page (browse games)
Route::get('/store', [StoreController::class, 'index'])
    ->middleware('auth')
    ->name('store');

// Wishlist page
Route::get('/wishlist', [WishlistController::class, 'index'])
    ->middleware('auth')
    ->name('wishlist');

// Library page
Route::get('/library/{product_id?}', [LibraryController::class, 'index'])
    ->middleware('auth')
    ->name('library');

// Wishlist actions
Route::post('/wishlist/add/{product_id}', [WishlistController::class, 'add'])
    ->middleware('auth')
    ->name('wishlist.add');

Route::post('/wishlist/remove/{product_id}', [WishlistController::class, 'remove'])
    ->middleware('auth')
    ->name('wishlist.remove');

// Library "claim / add"
Route::post('/library/add/{product_id}', [LibraryController::class, 'add'])
    ->middleware('auth')
    ->name('library.add');

// cart page
Route::get('/cart', [CartController::class, 'index'])
    ->middleware('auth')
    ->name('cart');

// add item to cart
Route::post('/cart/add/{product_id}', [CartController::class, 'add'])
    ->middleware('auth')
    ->name('cart.add');

// remove item from cart
Route::post('/cart/remove/{product_id}', [CartController::class, 'remove'])
    ->middleware('auth')
    ->name('cart.remove');

// checkout / purchase
Route::post('/cart/checkout', [CartController::class, 'checkout'])
    ->middleware('auth')
    ->name('cart.checkout');

// home
Route::get('/', [HomeController::class, 'index'])->name('home');

// product
Route::get('/game/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/', [HomeController::class, 'index'])->name('home');
