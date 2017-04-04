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


    // attribute router

    Route::group(['prefix' => 'attribute', 'namespace' => 'Attribute'], function () {
        Route::get('/', 'AttributeController@index')->name('attribute');
        Route::get('/create', 'AttributeController@create')->name('attribute.create');
        Route::post('/save', 'AttributeController@save')->name('attribute.save');
        Route::get('/edit/{id}', 'AttributeController@edit')->name('attribute.edit');
        Route::post('/update', 'AttributeController@update')->name('attribute.update');
        Route::get('/delete/{id}', 'AttributeController@delete')->name('attribute.delete');

        Route::group(['prefix' => 'option'], function () {
            Route::get('/', 'OptionController@index')->name('attribute.option');
            Route::get('/create', 'OptionController@create')->name('attribute.option.create');
            Route::post('/save', 'OptionController@save')->name('attribute.option.save');
            Route::get('/edit/{id}', 'OptionController@edit')->name('attribute.option.edit');
            Route::post('/update', 'OptionController@update')->name('attribute.option.update');
            Route::get('/delete/{id}', 'OptionController@delete')->name('attribute.option.delete');
        });

    });

    // cms router
    Route::group(['prefix' => 'cms', 'namespace' => 'Cms'], function () {
        // page router
        Route::group(['prefix' => 'page'], function () {
            Route::get('/', 'PageController@index')->name('cms.page');
            Route::get('/create', 'PageController@create')->name('cms.page.create');
            Route::post('/save', 'PageController@save')->name('cms.page.save');
            Route::get('/edit/{id}', 'PageController@edit')->name('cms.page.edit');
            Route::post('/update', 'PageController@update')->name('cms.page.update');
            Route::get('/delete/{id}', 'PageController@delete')->name('cms.page.delete');
        });
        // block router
        Route::group(['prefix' => 'block'], function () {
            Route::get('/', 'BlockController@index')->name('cms.block');
            Route::get('/create', 'BlockController@create')->name('cms.block.create');
            Route::post('/save', 'BlockController@save')->name('cms.block.save');
            Route::get('/edit/{id}', 'BlockController@edit')->name('cms.block.edit');
            Route::post('/update', 'BlockController@update')->name('cms.block.update');
            Route::get('/delete/{id}', 'BlockController@delete')->name('cms.block.delete');
        });
    });

    // user router
    Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
        Route::get('/', 'UserController@index')->name('user');
        Route::get('/create', 'UserController@create')->name('user.create');
        Route::post('/save', 'UserController@save')->name('user.save');
        Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
        Route::post('/update', 'UserController@update')->name('user.update');
        Route::get('/delete/{id}', 'UserController@delete')->name('user.delete');
    });

    // user role router
    Route::group(['prefix' => 'role', 'namespace' => 'User'], function () {
        Route::get('/', 'RoleController@index')->name('role');
        Route::get('/create', 'RoleController@create')->name('role.create');
        Route::post('/save', 'RoleController@save')->name('role.save');
        Route::get('/edit/{id}', 'RoleController@edit')->name('role.edit');
        Route::post('/update', 'RoleController@update')->name('role.update');
        Route::get('/delete/{id}', 'RoleController@delete')->name('role.delete');
    });
    // user permission router
    Route::group(['prefix' => 'permission', 'namespace' => 'User'], function () {
        Route::get('/', 'PermissionController@index')->name('permission');
        Route::get('/create', 'PermissionController@create')->name('permission.create');
        Route::post('/save', 'PermissionController@save')->name('permission.save');
        Route::get('/edit/{id}', 'PermissionController@edit')->name('permission.edit');
        Route::post('/update', 'PermissionController@update')->name('permission.update');
        Route::get('/delete/{id}', 'PermissionController@delete')->name('permission.delete');
    });
});
