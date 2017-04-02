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


//backend url


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    // dashboard
    Route::get('/', 'DashboardController@dashboard')->name('dashboard');
    // system config
    Route::group(['prefix' => 'system', 'namespace' => 'System'], function () {
        Route::get('/', 'ConfigController@index')->name('system.config');
    });
    // cms router
    Route::group(['prefix' => 'cms', 'namespace' => 'Cms'], function () {
        // page router
        Route::group(['prefix' => 'page'], function () {
            Route::get('/', 'PageController@index')->name('cms.page');
            Route::get('/create', 'PageController@create')->name('cms.page.create');
            Route::post('/save', 'PageController@save')->name('cms.page.save');
            Route::get('/edit/{id}', 'PageController@edit')->name('cms.page.edit');
            Route::post('/update/{id}', 'PageController@update')->name('cms.page.update');
            Route::get('/delete/{id}', 'PageController@delete')->name('cms.page.delete');
        });
        // block router
        Route::group(['prefix' => 'block'], function () {
            Route::get('/', 'BlockController@index')->name('cms.block');
            Route::get('/create', 'BlockController@create')->name('cms.block.create');
            Route::post('/save', 'BlockController@save')->name('cms.block.save');
            Route::get('/edit/{id}', 'BlockController@edit')->name('cms.block.edit');
            Route::post('/update/{id}', 'BlockController@update')->name('cms.block.update');
            Route::get('/delete/{id}', 'BlockController@delete')->name('cms.block.delete');
        });
    });

    // user router
    Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
        Route::get('/', 'UserController@index')->name('user');
        Route::get('/create', 'UserController@create')->name('user.create');
        Route::post('/save', 'UserController@save')->name('user.save');
        Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
        Route::post('/update/{id}', 'UserController@update')->name('user.update');
        Route::get('/delete/{id}', 'UserController@delete')->name('user.delete');
    });

    // user role router
    Route::group(['prefix' => 'role', 'namespace' => 'User'], function () {
        Route::get('/', 'UserController@index')->name('user');
        Route::get('/create', 'UserController@create')->name('user.create');
        Route::post('/save', 'UserController@save')->name('user.save');
        Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
        Route::post('/update/{id}', 'UserController@update')->name('user.update');
        Route::get('/delete/{id}', 'UserController@delete')->name('user.delete');
    });

});
