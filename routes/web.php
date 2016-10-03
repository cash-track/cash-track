<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('homepage');
Route::get('/dashboard', 'ProfileController@index')->name('dashboard');

Route::resource('/balance', 'BalanceController', ['except' => ['index']]);
Route::put('/balance/{id}/activate', 'BalanceController@activate')->name('balance.activate');
Route::put('/balance/{id}/disactivate', 'BalanceController@disactivate')->name('balance.disactivate');

Route::resource('/trans', 'TransController', ['only' => [
	'store', 'update', 'destroy'
]]);