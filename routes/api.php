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

Route::group(['namespace' => 'API'], function () {
    Route::post('/auth.json', 'AuthController@auth')->middleware('guest');
    Route::post('/logout.json', 'AuthController@logout');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/draws.json', 'DrawController@list');
        Route::post('/draw.json', 'DrawController@draw');
        Route::post('/draw/exchange/{draw}.json', 'DrawController@exchange');
    });
});
