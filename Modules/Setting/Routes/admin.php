<?php

Route::get('settings', [
    'as' => 'admin.settings.edit',
    'uses' => 'SettingController@edit',
    'middleware' => 'can:admin.settings.edit',
]);

Route::put('settings', [
    'as' => 'admin.settings.update',
    'uses' => 'SettingController@update',
    'middleware' => 'can:admin.settings.edit',
]);

Route::get('settings/cache-clear', [
    'as' => 'admin.settings.cacheClear',
    'uses' => 'SettingController@cacheClear',
    'middleware' => 'can:admin.settings.edit',
]);

Route::get('settings/update-sitemap', [
    'as' => 'admin.settings.updateSitemap',
    'uses' => 'SitemapController@index',
    'middleware' => 'can:admin.settings.edit',
]);