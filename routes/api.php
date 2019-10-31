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

Route::apiResource('/todos','TodoController');

Route::apiResource('/todos/{todo}/items','ItemController');

Route::apiResource('/todos/{todo}/items/{item}/card','CardController');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('signup', 'AuthController@signup')->name('signup');
    Route::post('login', 'AuthController@login')->name('login');
    
    Route::post('logout', 'AuthController@logout');
    
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('payload', 'AuthController@payload');
    
});