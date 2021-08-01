<?php

Route::post('favorite', 'FavoriteController@store')->middleware('auth')->name('favorite.store');
