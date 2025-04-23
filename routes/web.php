<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\TireController;

use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\LangugeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Customer\CartController;

// Route::get('/', function () {
//     return view('welcome');
// });

// login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-process', [AuthController::class, 'loginProcess'])->name('loginProcess');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// authenticate
Route::middleware('authenticate')->group(function () {
    // dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('tires', TireController::class);
    Route::resource('products', ProductController::class);

    Route::get('/tire/inventory', [TireController::class, 'inventory'])->name('tires.inventory');
    // search
    Route::get('/tire/search', [TireController::class, 'search'])->name('tires.search');

    // add user
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'list'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::post('/status/{id}', [UserController::class, 'status'])->name('user.status');
    });


    // lang change
    Route::get('change', [LangugeController::class, 'change'])->name('lang.change');

    Route::get('tire/import', [TireController::class, 'showImportForm'])->name('tires.import.form');
    Route::post('tire/import', [TireController::class, 'import'])->name('tires.import');
});
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{tire}', [CartController::class, 'add'])->name('add');
    Route::post('/update/{tire}', [CartController::class, 'update'])->name('update');
    Route::post('/remove/{tire}', [CartController::class, 'remove'])->name('remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('clear');
    // cart count
    Route::get('/count', [CartController::class, 'count'])->name('count');
});



// checkout place order
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/place-order', [CartController::class, 'placeOrder'])->name('cart.placeOrder');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
    Route::get('/orders/{order}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');

});




