<?php

Route::get('contact', 'ContactController@create')->name('contact.create');
Route::post('contact', 'ContactController@store')->name('contact.store');
