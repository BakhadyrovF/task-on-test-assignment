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

Route::group(['middleware' => 'guest:web', 'controller' => \App\Http\Controllers\Client\AuthController::class], function () {
    Route::get('/login', 'loginView')->name('auth.login');
    Route::post('/login-action', 'logIn')->name('auth.login-action');
});

//Route::group(['middleware' => 'auth:web', 'controller' => ]);
