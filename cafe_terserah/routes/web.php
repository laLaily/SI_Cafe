<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DetailDineinTransactionController;
use App\Http\Controllers\DineinTransactionController;
use App\Http\Controllers\DineResController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReservationTransactionController;
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

Route::prefix('/admin')->group(function () {
    Route::get('/get', [AdminController::class, 'getAdmins']);

    Route::post('/create', [AdminController::class, 'insertAdmin']);
    Route::get('/login', function(){
        return view('admin.login_admin');
    });
    Route::post('/login/process', [AdminController::class, 'loginAdmin']);
    Route::delete('/delete/{id}', [AdminController::class, 'deleteAdmin']);
    
    Route::middleware(['myauth'])->group(function () {
        Route::get('/logout', [AdminController::class, 'logoutAdmin']);
        Route::get('/dashboard', [AdminController::class, 'getAdmin']);
        Route::put('/change/password/{id}', [AdminController::class, 'updatePasswordAdmin']);

        Route::prefix('/product')->group(function () {
            Route::post('/create', [ProductController::class, 'insertProduct']);
            Route::get('/view', [ProductController::class, 'getProducts']);
            Route::get('/view/{id}', [ProductController::class, 'getOneProduct']);
            Route::post('/delete/{id}', [ProductController::class, 'deleteProduct']);
            Route::post('/update/process/{id}', [ProductController::class, 'update']);
        });

        Route::prefix('/seat')->group(function () {
            Route::post('/create', [SeatController::class, 'createSeat']);
            Route::get('/view', [SeatController::class, 'getSeats']);
            Route::get('/viewSeat', [SeatController::class, 'getSeatList']);
            Route::get('/view/{id}', [SeatController::class, 'getOneSeat']);
            Route::post('/delete/{id}', [SeatController::class, 'deleteSeat']);
            Route::post('/update/process/{id}', [SeatController::class, 'updateSeat']);
        });

        Route::prefix('/admin')->group(function(){
            Route::post('/create', [AdminController::class, 'insertAdmin']);
            Route::get('/view', [AdminController::class, 'getAdmins']);
            Route::post('/update/process/{id}', [AdminController::class, 'updatePasswordAdmin']);
            Route::delete('/delete/{id}', [AdminController::class, 'deleteAdmin']);
        });
    });
});

Route::prefix('/dinein')->group(function () {
    Route::get('/order', [SeatController::class, 'getSeats']);
    Route::post('/order/process', [DineResController::class, 'dineresControl']);
    Route::get('/order/products', [DineinTransactionController::class, 'userCart']);
    Route::post('/order/products/process', [DetailDineinTransactionController::class, 'createDetailDineinTrasaction']);
    Route::post('/order/products/delete', [DetailDineinTransactionController::class, 'deleteProductCart']);
    Route::get('/order/submit', [DineinTransactionController::class, 'submitCart']);
    Route::get('/order/success', function () {
        return view('order.dinein_response');
    });
});

Route::prefix('/reservation')->group(function () {
    Route::get('/order', function () {
        return view('order.reservation_regis');
    });
    Route::post('/order/process', [ReservationTransactionController::class, 'createReservationTransaction']);
    Route::get('/feature', function () {
        return view('order.reservation_response');
    });
    Route::get('/confirm', [ReservationTransactionController::class, 'submitReservation']);
});
