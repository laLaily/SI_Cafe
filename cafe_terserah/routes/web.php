<?php

use App\Http\Controllers\AdminController;
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
    return view('welcome');
});

Route::post('/admin/create', [AdminController::class, 'insertAdmin']);

Route::get('/admin', [AdminController::class, 'getAdmins']);

Route::get('/admin/{id}', [AdminController::class, 'getAdmin']);

Route::post('/admin/change/password/{id}', [AdminController::class, 'updatePasswordAdmin']);

Route::post('/admin/delete/{id}', [AdminController::class, 'deleteAdmin']);

Route::post('/admin/login', [AdminController::class, 'loginAdmin']);
