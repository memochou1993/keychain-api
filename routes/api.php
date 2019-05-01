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

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('register', 'AuthController@register')->name('register');
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout')->name('logout')->middleware('auth:api');
    Route::get('user', 'AuthController@user')->name('user')->middleware('auth:api');
    Route::post('password/reset', 'AuthController@resetPassword')->name('password.reset')->middleware('auth:api');
});

Route::post('users', 'UserController@store')->name('users.store');
Route::resource('users', 'UserController')->middleware('auth:api')->except(['create', 'store', 'edit']);

Route::namespace('User')->middleware('auth:api')->prefix('users/me')->name('users.me.')->group(function () {
    Route::post('keys/{key}', 'KeyController@show')->name('keys.show');
    Route::resource('keys', 'KeyController')->except(['create', 'show', 'edit']);
});
