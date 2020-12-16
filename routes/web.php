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

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => 'check.cookie'
], function () {
    Route::get('home', 'App\Http\Controllers\Dashboard\ShowDashboardAction')->name('home');
    Route::get('logout', 'App\Http\Controllers\Auth\LogoutAction')->name('logout');
});

Route::get('login', 'App\Http\Controllers\Auth\LoginAction')->name('login');
Route::post('login', 'App\Http\Controllers\Auth\LoginAction@post')->name('login.post');
