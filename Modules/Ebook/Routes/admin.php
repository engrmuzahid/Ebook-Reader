<?php

Route::get('ebooks', [
    'as' => 'admin.ebooks.index',
    'uses' => 'EbookController@index',
    'middleware' => 'can:admin.ebooks.index',
]);

Route::get('ebooks/create', [
    'as' => 'admin.ebooks.create',
    'uses' => 'EbookController@create',
    'middleware' => 'can:admin.ebooks.create',
]);

Route::post('ebooks', [
    'as' => 'admin.ebooks.store',
    'uses' => 'EbookController@store',
    'middleware' => 'can:admin.ebooks.create',
]);

Route::get('ebooks/{id}', [
    'as' => 'admin.ebooks.show',
    'uses' => 'EbookController@show',
    'middleware' => 'can:admin.ebooks.edit',
]);

Route::get('ebooks/{id}/edit', [
    'as' => 'admin.ebooks.edit',
    'uses' => 'EbookController@edit',
    'middleware' => 'can:admin.ebooks.edit',
]);

Route::put('ebooks/{id}', [
    'as' => 'admin.ebooks.update',
    'uses' => 'EbookController@update',
    'middleware' => 'can:admin.ebooks.edit',
]);

Route::delete('ebooks/{ids}', [
    'as' => 'admin.ebooks.destroy',
    'uses' => 'EbookController@destroy',
    'middleware' => 'can:admin.ebooks.destroy',
]);

Route::get('reported-ebooks', [
    'as' => 'admin.reportedebooks.index',
    'uses' => 'ReportedEbookController@index',
    'middleware' => 'can:admin.reportedebooks.index',
]);

Route::delete('reported-ebooks/{ids}', [
    'as' => 'admin.reportedebooks.destroy',
    'uses' => 'ReportedEbookController@destroy',
    'middleware' => 'can:admin.reportedebooks.destroy',
]);