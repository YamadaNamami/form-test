<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConfirmController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;

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

Route::get('/', [ContactController::class, 'index']);
Route::post('/', [ContactController::class, 'confirm']);

Route::post('/confirm', [ConfirmController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/search', [AdminController::class, 'search']);
    Route::post('/admin/export', [AdminController::class, 'export']);
    Route::get('/admin/detail', [AdminController::class, 'detail']);
    Route::delete('/admin/delete', [AdminController::class, 'destroy']);
});