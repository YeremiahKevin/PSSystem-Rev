<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'LoginController@userLogin');

Route::post('register', 'LoginController@userRegister');

Route::group(['prefix' => 'parameter', 'as' => 'parameter'], function () {
    Route::post('select-phone', 'SelectParameterController@selectPhone');
});

Route::post('/transaction', 'TransactionController@phoneTransaction');

Route::get('/report/{month_number}', 'ReportController@getReportMonthly');

Route::post('/new-item', 'PhoneController@addPhone');

Route::post('/new-item-detail', 'PhoneController@addPhoneDetail');

Route::post('/add-phone-stock', 'PhoneController@addPhoneStock');

Route::post('/update-phone-price', 'PhoneController@updatePhonePrice');
