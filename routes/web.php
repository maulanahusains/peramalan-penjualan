<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/attempt-login', [LoginController::class, 'login'])->name('postlogin');
Route::post('/check-reset-password', [LoginController::class, 'check_to_reset_password'])->name('check-reset-password');
Route::post('/reset-password', [LoginController::class, 'reset_password'])->name('reset-password');
Route::get('/view-reset-password', [LoginController::class, 'view_reset_password'])->name('view-reset-password');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::prefix('kelola-data')->name('kelola.')->group(function () {
        Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');
        });

        Route::prefix('produk')->name('produk.')->controller(ProdukController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');
        });

        Route::prefix('supplier')->name('supplier.')->controller(SupplierController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');
        });

        Route::prefix('stok')->name('stok.')->controller(ProdukController::class)->group(function () {
            Route::get('/', 'index_stok')->name('index');
        });
    });

    Route::prefix('penjualan')->name('penjualan.')->controller(PenjualanController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });
});
