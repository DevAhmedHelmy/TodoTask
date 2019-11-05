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

// Route::view('/','home');
Route::view('/{any}','home');
Route::view('/{any}/{any1}','home');

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/{vue_capture?}', function () {
//     return view('layouts.master');
// })->where('vue_capture', '[\/\w\.-]*');

// Route::get('/login',function(){
// 	return view('login.login');
// });