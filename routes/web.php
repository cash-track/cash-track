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
Route::get('/profile', 'ProfileController@profile')->name('profile');
Route::get('/profile/setting/{section?}', 'ProfileController@setting')->name('profile.settings');
Route::patch('/profile/setting/{section?}/{action}', 'ProfileController@update')
    ->name('profile.update');

Route::resource('/balance', 'BalanceController', ['except' => ['index']]);
Route::put('/balance/{id}/activate', 'BalanceController@activate')->name('balance.activate');
Route::put('/balance/{id}/disactivate', 'BalanceController@disactivate')->name('balance.disactivate');
Route::get('/balance/{id}/invite', 'BalanceController@showInvite')->name('balance.showInvite');
Route::put('/balance/{id}/invite', 'BalanceController@invite')->name('balance.invite');

Route::resource('/trans', 'TransController', ['only' => [
    'store', 'update', 'destroy',
]]);
