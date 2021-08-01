<?php

Route::get('/', 'AdminController@index')->name('admin.dashboard.index');

Route::get('activity', [
    'as' => 'admin.activity.index',
    'uses' => 'ActivityController@index',
    'middleware' => 'can:admin.activity.index',
]);