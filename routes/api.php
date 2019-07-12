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
        Route::get('/draw.json', 'DrawController@last');
        Route::post('/draw.json', 'DrawController@draw');
        Route::post('/draw/reject.json', 'DrawController@cancel');
        Route::post('/draw/exchange.json', 'DrawController@exchange');
        Route::post('/draw/accept.json', 'DrawController@accept');
    });
});
