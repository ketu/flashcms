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

$backendPrefix = Config::get('route.backend.prefix');

Route::group(['prefix' => $backendPrefix, 'namespace'=> 'Backend'], function () {

    Auth::routes();

    Route::get('/', 'DashboardController@dashboard')->name('dashboard');

    Route::group(['prefix' => 'system', 'namespace'=> 'System'], function () {
        Route::get('/', 'ConfigController@index')->name('system.config');
    });

});
