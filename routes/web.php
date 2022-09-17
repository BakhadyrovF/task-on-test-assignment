<?php

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
Route::get('/', fn() => redirect()->route('warehouses.index'));

Route::group(['middleware' => 'guest:web', 'controller' => \App\Http\Controllers\Client\AuthController::class], function () {
    Route::get('/login', 'loginView')->name('auth.login');
    Route::post('/login-action', 'logIn')->name('auth.login-action');
});

Route::group(['middleware' => 'auth:web'], function () {
    Route::post('/logout', [\App\Http\Controllers\Client\AuthController::class, 'logOut'])->name('auth.logout');
    Route::resource('warehouses', \App\Http\Controllers\Client\WarehouseController::class)->except('edit', 'update', 'show');
    Route::resource('products', \App\Http\Controllers\Client\ProductController::class)->except('show');
});
