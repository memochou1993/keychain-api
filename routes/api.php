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

Route::namespace('Auth')->prefix('auth')->name('auth.')->group(function () {
    Route::post('register', 'AuthController@register')->name('register');
    Route::post('verify', 'AuthController@verify')->name('verify');
    Route::post('login', 'AuthController@login')->middleware('throttle:20,1')->name('login');
    Route::post('logout', 'AuthController@logout')->name('logout')->middleware('auth:api');
    Route::get('user', 'AuthController@user')->name('user')->middleware('auth:api');
    Route::post('password/reset', 'AuthController@resetPassword')->name('password.reset')->middleware('auth:api');
});

Route::post('users', 'UserController@store')->name('users.store');
Route::apiResource('users', 'UserController')->middleware('auth:api')->except(['store']);

Route::namespace('User')->middleware('auth:api')->prefix('users/me')->name('users.me.')->group(function () {
    Route::post('keys/{key}', 'KeyController@show')->middleware('throttle:20,1')->name('keys.show');
    Route::apiResource('keys', 'KeyController')->except(['edit']);
});
