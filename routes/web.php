<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product Routes
    Route::resource('products', ProductController::class);
    // Supplier Routes
    Route::resource('suppliers', SupplierController::class);
    // Customer Routes
    Route::resource('customers', CustomerController::class);
    // Purchase Routes
    Route::resource('purchases', PurchaseController::class)->except(
        [
            'show',
            'edit',
            'update'
        ]
    );

    // Sale Routes
    Route::resource('sales', SaleController::class)->except(
        [
            'show',
            'edit',
            'update'
        ]
    );


    // Expense Routes
    Route::resource('expenses', ExpenseController::class)->except(
        [
            'show',
            'edit',
            'update'
        ]
    );
    Route::get('financial-report', [ExpenseController::class, 'report'])->name('financial.report');


});

require __DIR__ . '/auth.php';
