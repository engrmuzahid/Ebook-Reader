<?php

Route::get('files-manager', [
    'as' => 'admin.files.manager',
    'uses' => 'FilesController@filesManager',
    'middleware' => 'can:admin.files.index',
]);

Route::get('files', [
    'as' => 'admin.files.index',
    'uses' => 'FilesController@index',
    'middleware' => 'can:admin.files.index',
]);

Route::post('files', [
    'as' => 'admin.files.store',
    'uses' => 'FilesController@store',
    'middleware' => 'can:admin.files.create',
]);

Route::delete('files/{ids?}', [
    'as' => 'admin.files.destroy',
    'uses' => 'FilesController@destroy',
    'middleware' => 'can:admin.files.destroy',
]);

Route::get('files/download/{ids}', 'FilesController@download')->name('admin.files.download');