<?php

Route::get('cynoebook', [
    'as' => 'admin.cynoebook.settings.edit',
    'uses' => 'CynoebookController@edit',
    'middleware' => 'can:admin.cynoebook.edit',
]);

Route::put('cynoebook', [
    'as' => 'admin.cynoebook.settings.update',
    'uses' => 'CynoebookController@update',
    'middleware' => 'can:admin.cynoebook.edit',
]);
