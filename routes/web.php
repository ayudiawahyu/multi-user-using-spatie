<?php

use App\Http\Controllers\AdminManageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerManageController;
use App\Http\Controllers\CustomerMenuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'showLoginForm']);

Auth::routes();

Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('home.admin');
    Route::resource('menu', MenuController::class)->except(['create', 'edit', 'show']);
    Route::patch('menu/available/{menu}', [MenuController::class, 'available'])->name('menu.available');
    Route::patch('menu/unavailable/{menu}', [MenuController::class, 'unavailable'])->name('menu.unavailable');
    Route::get('pending', [AdminManageController::class, 'pending'])->name('pending');
    Route::get('customer', [CustomerController::class, 'index']);
    Route::get('history', [AdminManageController::class, 'done'])->name('done');
    Route::put('order/{order}/pay', [OrderController::class, 'pay'])->name('order.pay');
    
});

Route::prefix('customer')->middleware(['auth', 'role:customer'])->name('customer.')->group(function () {
    Route::get('menu', [CustomerMenuController::class, 'index'])->name('menu');
    Route::get('order', [CustomerMenuController::class, 'order'])->name('order');
    Route::post('order', [OrderController::class, 'store'])->name('order.store');
    Route::get('pending', [CustomerManageController::class, 'pending'])->name('pending');
    Route::get('history', [CustomerManageController::class, 'done'])->name('done');
    Route::get('history/{order}', [OrderController::class, 'show'])->name('history.show');
});
Route::get('pending/{order}', [OrderController::class, 'show'])->name('pending.show');
// Route::get('/laporan/penjualan', [LaporanController::class, 'laporanPenjualan'])->name('laporan.show');

Route::get('profile', [UserController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('profile', [UserController::class, 'update'])->name('profile.update')->middleware('auth');