<?php

// Authentication
Auth::routes();

// Front
Route::get('/', 'HomeController@index')->name('homepage');
Route::get('/dashboard', 'ProfileController@index')->name('dashboard');
Route::get('/help', 'HomeController@help')->name('help');
Route::get('/about', 'HomeController@about')->name('about');

// Profile
Route::get('/profile', 'ProfileController@profile')->name('profile');
Route::get('/profile/setting/{section?}', 'ProfileController@setting')->name('profile.settings');
Route::patch('/profile/setting/{section?}/{action}', 'ProfileController@update')->name('profile.update');

// Users
Route::get('/user/{user?}', 'ProfileController@profile')->name('user.show');
Route::get('/user/{user?}/balance/{balance}', 'BalanceController@byOwner')->name('user.balance');

// Balance
Route::get('/balance/create', 'BalanceController@create')->name('balance.create');
Route::post('/balance', 'BalanceController@store')->name('balance.store');
Route::get('/balance/{balance}', 'BalanceController@show')->name('balance.show');
Route::get('/balance/{balance}/edit', 'BalanceController@edit')->name('balance.edit');
Route::put('/balance/{balance}', 'BalanceController@update')->name('balance.update');
Route::delete('/balance/{balance}', 'BalanceController@destroy')->name('balance.destroy');

Route::put('/balance/{id}/activate', 'BalanceController@activate')->name('balance.activate');
Route::put('/balance/{id}/disactivate', 'BalanceController@disactivate')->name('balance.disactivate');
Route::get('/balance/{id}/invite', 'BalanceController@showInvite')->name('balance.showInvite');
Route::put('/balance/{id}/invite', 'BalanceController@invite')->name('balance.invite');
Route::post('/balance/invite-user-autocomplete', 'BalanceController@inviteAutoComplete')->name('balance.invite-user-autocomplete');
Route::patch('/balance/{id}/uninvite/{user}', 'BalanceController@unInvite')->name('balance.uninvite');

// Transaction
Route::post('/trans', 'TransController@store')->name('trans.store');
Route::put('/trans/{trans}', 'TransController@update')->name('trans.update');
Route::delete('/trans/{trans}', 'TransController@destroy')->name('trans.destroy');