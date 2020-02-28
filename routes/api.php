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
Route::get('food-schedule/today', 'API\FoodScheduleController@scheduled');

Route::apiResource('users', 'API\UserController');
Route::apiResource('order-details', 'API\OrderDetailController');
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('user', 'API\UserController@details');
    Route::apiResource('users', 'API\UserController');
    Route::apiResource('foods', 'API\FoodController');
    Route::apiResource('schedules', 'API\FoodScheduleController');
    Route::apiResource('schedule-details','API\FoodScheduleDetailController');
    Route::apiResource('orders', 'API\OrderController');
    Route::get('order/today', 'API\OrderController@ordered');
});
