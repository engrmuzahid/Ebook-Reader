<?php

Route::get('authors', 'AuthorController@index')->name('authors.index');
Route::get('authors/{slug}', 'AuthorController@show')->name('authors.show');