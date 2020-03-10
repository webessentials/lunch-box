<?php

use Illuminate\Http\Request;

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
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::get('schedule/today', 'API\ScheduleController@today');

Route::apiResource('users', 'API\UserController');
Route::apiResource('order-details', 'API\OrderDetailController');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('user', 'API\UserController@details');
    Route::post('logout','API\UserController@logout');
    Route::apiResource('users', 'API\UserController');

    Route::apiResource('foods', 'API\FoodController');
    Route::apiResource('schedules', 'API\ScheduleController');
    Route::post('/delete/schedules', 'API\ScheduleController@destroy');
    Route::apiResource('schedule-details','API\FoodScheduleDetailController');
    Route::post('orders/cancel', 'API\OrderController@destroy');
    Route::get('orders/user-today', 'API\OrderController@orderedByCurrentUser');
    Route::get('orders/today/{food}', 'API\OrderDetailController@today');
    Route::apiResource('orders', 'API\OrderController');
    Route::put('order/payment-status', 'API\OrderController@paymentStatus');
});

