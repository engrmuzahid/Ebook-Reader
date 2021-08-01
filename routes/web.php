<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
});
 */
 
Route::get('installer/index', 'InstallerController@index');
Route::get('installer/requirements', 'InstallerController@serverRequirements');
Route::get('installer/configuration', 'InstallerController@environmentConfiguration');
Route::post('installer/configuration', 'InstallerController@postConfiguration');
Route::get('installer/complete', 'InstallerController@complete');