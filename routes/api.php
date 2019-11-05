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

Route::get('/todos/{todo}/items/{item}/card','CardController@index');
Route::post('/todos/{todo}/items/{item}/card','CardController@store');

Route::get('/card/{card}','CardController@show');

Route::put('/card/{card}','CardController@update');
Route::delete('/card/{card}','CardController@destroy');

Route::get('/comments/{card}','CommentController@show');

// Route::apiResource('comments','CommentController');
Route::get('/comments','CommentController@index');
// Route::post('/comments','CommentController@store');
// Route::put('/comments/{comment}','CommentController@store');



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('signup', 'AuthController@signup')->name('signup');
    Route::post('logout', 'AuthController@logout');
    
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('payload', 'AuthController@payload');
    
});