<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('buy', function () {
    return view('buy');
});

Route::get('report',function () {
    return view('report');
});

Route::get('new-item', function () {
    return view('new-item');
});

Route::get('new-item-detail', function () {
    return view('new-item-detail');
});

Route::get('add-phone-stock', function () {
    return view('add-phone-stock');
});

Route::get('update-phone-price', function () {
    return view('update-phone-price');
});

Route::get('view-all-phones', function () {
    return view('view-all-phones');
});
