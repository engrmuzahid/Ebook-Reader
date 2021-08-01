<?php

Route::get('login', 'AuthController@getLoginView')->name('login');
Route::post('login', 'AuthController@postLogin')->name('login.post');

Route::get('login/{provider}', 'AuthController@redirectToProvider')->name('login.redirect');
Route::get('login/{provider}/callback', 'AuthController@handleProviderCallback')->name('login.callback');

Route::get('logout', 'AuthController@getLogout')->name('logout');

Route::get('register', 'AuthController@getRegisterView')->name('register');
Route::post('register', 'AuthController@postRegister')->name('register.post');

Route::get('password/reset', 'AuthController@getResetView')->name('reset');
Route::post('password/reset', 'AuthController@postReset')->name('reset.post');
Route::get('password/reset/{email}/{code}', 'AuthController@getResetComplete')->name('reset.complete');
Route::post('password/reset/{email}/{code}', 'AuthController@postResetComplete')->name('reset.complete.post');
