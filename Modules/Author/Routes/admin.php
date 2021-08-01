<?php

Route::get('authors', [
    'as' => 'admin.authors.index',
    'uses' => 'AuthorController@index',
    'middleware' => 'can:admin.authors.index',
]);

Route::get('authors/create', [
    'as' => 'admin.authors.create',
    'uses' => 'AuthorController@create',
    'middleware' => 'can:admin.authors.create',
]);

Route::post('authors', [
    'as' => 'admin.authors.store',
    'uses' => 'AuthorController@store',
    'middleware' => 'can:admin.authors.create',
]);

Route::get('authors/{id}', [
    'as' => 'admin.authors.show',
    'uses' => 'AuthorController@show',
    'middleware' => 'can:admin.authors.edit',
]);

Route::get('authors/{id}/edit', [
    'as' => 'admin.authors.edit',
    'uses' => 'AuthorController@edit',
    'middleware' => 'can:admin.authors.edit',
]);

Route::put('authors/{id}', [
    'as' => 'admin.authors.update',
    'uses' => 'AuthorController@update',
    'middleware' => 'can:admin.authors.edit',
]);

Route::delete('authors/{ids?}', [
    'as' => 'admin.authors.destroy',
    'uses' => 'AuthorController@destroy',
    'middleware' => 'can:admin.authors.destroy',
]);
