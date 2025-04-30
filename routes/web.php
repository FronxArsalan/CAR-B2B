<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\TireController;

use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\LangugeController;
use App\Http\Controllers\Admin\SupportTicketController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\GoogleSheetController;

// Route::get('/', function () {
//     return view('welcome');
// });

// login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-process', [AuthController::class, 'loginProcess'])->name('loginProcess');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// language change
Route::get('change', [LangugeController::class, 'change'])->name('lang.change');

// only authenticat
Route::middleware(['authenticate'])->group(function () {

    // dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // search
    Route::get('/tire/search', [TireController::class, 'search'])->name('tires.search');


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });



     // customer_support
     Route::prefix('support')->group(function () {
        Route::get('/', [SupportTicketController::class, 'index'])->name('support.index');
        Route::get('/create', [SupportTicketController::class, 'create'])->name('support.create');
        Route::post('/store', [SupportTicketController::class, 'store'])->name('support.store');
        Route::get('/{ticket}', [SupportTicketController::class, 'show'])->name('support.show');
        Route::post('/{ticket}/reply', [SupportTicketController::class, 'reply'])->name('support.reply');
    });
});
// stock_manager and admin
Route::middleware(['is_stock_manager'])->group(function () {
    Route::resource('tires', TireController::class);
    Route::get('/tire/inventory', [TireController::class, 'inventory'])->name('tires.inventory');

    Route::get('tire/import', [TireController::class, 'showImportForm'])->name('tires.import.form');
    Route::post('tire/import', [TireController::class, 'import'])->name('tires.import');

    Route::post('/admin/sync-products', [TireController::class, 'syncProductsManually'])->name('admin.sync-products');

    Route::get('/admin/google-sheet', [TireController::class, 'fetchSheetData'])->name('fetch-google-sheet');
});
// authenticate and admin
Route::middleware(['authenticate', 'is_admin'])->group(function () {



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

    

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
        Route::get('/orders/{order}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');
    });


    
});


// authenticate and user
Route::middleware(['authenticate', 'is_customer'])->group(function () {
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{tire}', [CartController::class, 'add'])->name('add');
        Route::post('/update/{tire}', [CartController::class, 'update'])->name('update');
        Route::post('/remove/{tire}', [CartController::class, 'remove'])->name('remove');
        Route::post('/clear', [CartController::class, 'clear'])->name('clear');
        Route::get('/count', [CartController::class, 'count'])->name('count');
    });

    // checkout place order
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/place-order', [CartController::class, 'placeOrder'])->name('cart.placeOrder');
});


Route::prefix('google-sheet')->group(function () {
    Route::get('/', [GoogleSheetController::class, 'index'])->name('google-sheet.index');
    Route::get('/create', [GoogleSheetController::class, 'create'])->name('google-sheet.create');
    Route::post('/', [GoogleSheetController::class, 'store'])->name('google-sheet.store');
    Route::get('/edit/{row}', [GoogleSheetController::class, 'edit'])->name('google-sheet.edit');
    Route::put('/{row}', [GoogleSheetController::class, 'update'])->name('google-sheet.update');
    Route::delete('/{row}', [GoogleSheetController::class, 'destroy'])->name('google-sheet.destroy');
});