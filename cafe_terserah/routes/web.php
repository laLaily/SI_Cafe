<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DetailDineinTransactionController;
use App\Http\Controllers\DineinTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SeatController;
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

Route::get('/', function () {
    return view('order.dashboard');
});

Route::get('/home', function () {
    return view('order.dashboard');
});

Route::prefix('/admin')->group(function () {
    Route::get('/get', [AdminController::class, 'getAdmins']);

    Route::post('/create', [AdminController::class, 'insertAdmin']);
    Route::post('/login', [AdminController::class, 'loginAdmin']);
    Route::delete('/delete/{id}', [AdminController::class, 'deleteAdmin']);

    Route::middleware(['myauth'])->group(function () {
        Route::get('/logout', [AdminController::class, 'logoutAdmin']);
        Route::get('/dashboard', [AdminController::class, 'getAdmin']);
        Route::put('/change/password/{id}', [AdminController::class, 'updatePasswordAdmin']);

        Route::prefix('/product')->group(function () {
            Route::post('/create', [ProductController::class, 'insertProduct']);
            Route::get('/get', [ProductController::class, 'getProducts']);
            Route::get('/get/{id}', [ProductController::class, 'getOneProduct']);
        });

        Route::prefix('/seat')->group(function () {
            Route::post('/create', [SeatController::class, 'createSeat']);
            Route::get('/get', [SeatController::class, 'getSeats']);
        });
    });
});

Route::prefix('/dinein')->group(function () {
    Route::get('/order', [SeatController::class, 'getSeats']);
    Route::post('/order/process', [DineinTransactionController::class, 'createDineinTransaction']);
    Route::get('/order/products', [CartController::class, 'userCart']);
    Route::post('/order/products/process', [DetailDineinTransactionController::class, 'createDetailDineinTrasaction']);
    Route::post('/order/products/delete', [DetailDineinTransactionController::class, 'deleteProductCart']);
    Route::get('/order/submit', [CartController::class, 'submitCart']);
});
