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


Route::group(['namespace' => 'Auth'], function () {
// Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name("backend.login");
    Route::post('login', 'LoginController@login')->name("backend.login");
    Route::post('logout', 'LoginController@logout')->name('backend.logout');

});


Route::group(['middleware' => 'auth'], function () {
    // dashboard
    Route::get('/', 'DashboardController@dashboard')->name('dashboard');
    // system config
    Route::group(['prefix' => 'system', 'namespace' => 'System'], function () {
        Route::get('/', 'ConfigController@index')->name('system.config');
    });
    // links router
    Route::group(['prefix' => 'links', 'namespace' => 'Link'], function () {
        Route::get('/', 'LinkController@index')->name('links');
        Route::get('/create', 'LinkController@create')->name('links.create');
        Route::post('/save', 'LinkController@save')->name('links.save');
        Route::get('/edit/{id}', 'LinkController@edit')->name('links.edit');
        Route::post('/update', 'LinkController@update')->name('links.update');
        Route::get('/delete/{id}', 'LinkController@delete')->name('links.delete');
    });

    // menu router
    Route::group(['prefix' => 'menu', 'namespace' => 'Menu'], function () {
        Route::get('/', 'MenuController@index')->name('menu');
        Route::get('/create', 'MenuController@create')->name('menu.create');
        Route::post('/save', 'MenuController@save')->name('menu.save');
        Route::get('/edit/{id}', 'MenuController@edit')->name('menu.edit');
        Route::post('/update', 'MenuController@update')->name('menu.update');
        Route::get('/delete/{id}', 'MenuController@delete')->name('menu.delete');




        Route::get('/{menuId}/item', 'ItemController@index')->name('menu.item');
        Route::get('/{menuId}/item/create', 'ItemController@create')->name('menu.item.create');
        Route::post('/item/save', 'ItemController@save')->name('menu.item.save');
        Route::get('/item/edit/{id}', 'ItemController@edit')->name('menu.item.edit');
        Route::post('/item/update', 'ItemController@update')->name('menu.item.update');
        Route::get('/item/delete/{id}', 'ItemController@delete')->name('menu.item.delete');
    });

    // newsletter subscriber router
    Route::group(['prefix' => 'newsletter', 'namespace' => 'Newsletter'], function () {
        Route::group(['prefix' => 'subscriber'], function () {
            Route::get('/', 'SubscriberController@index')->name('subscriber');
            Route::get('/create', 'SubscriberController@create')->name('subscriber.create');
            Route::post('/save', 'SubscriberController@save')->name('subscriber.save');
            Route::get('/edit/{id}', 'SubscriberController@edit')->name('subscriber.edit');
            Route::post('/update', 'SubscriberController@update')->name('subscriber.update');
            Route::get('/delete/{id}', 'SubscriberController@delete')->name('subscriber.delete');
        });
    });

    // catalog router
    Route::group(['prefix' => 'catalog', 'namespace' => 'Catalog'], function () {
        //product router
        Route::group(['prefix' => 'product'], function () {
            Route::get('/', 'ProductController@index')->name('product');
            Route::get('/create', 'ProductController@create')->name('product.create');
            Route::post('/save', 'ProductController@save')->name('product.save');
            Route::get('/edit/{id}', 'ProductController@edit')->name('product.edit');
            Route::post('/update', 'ProductController@update')->name('product.update');
            Route::get('/delete/{id}', 'ProductController@delete')->name('product.delete');

            // product gallery
            Route::post('/{id}/gallery/upload', 'GalleryController@upload')->name('product.gallery.upload');
            Route::post('/{id}/gallery/delete', 'GalleryController@delete')->name('product.gallery.delete');



        });
        // product template
        Route::group(['prefix' => 'template'], function () {
            Route::get('/', 'TemplateController@index')->name('template');
            Route::get('/create', 'TemplateController@create')->name('template.create');
            Route::post('/save', 'TemplateController@save')->name('template.save');
            Route::get('/edit/{id}', 'TemplateController@edit')->name('template.edit');
            Route::post('/update', 'TemplateController@update')->name('template.update');
            Route::get('/delete/{id}', 'TemplateController@delete')->name('template.delete');
            Route::get('/attributes', 'TemplateController@attributes')->name('template.attributes');

        });
        //category router
        Route::group(['prefix' => 'category'], function () {
            Route::get('/', 'CategoryController@index')->name('category');
            Route::get('/create', 'CategoryController@create')->name('category.create');
            Route::post('/save', 'CategoryController@save')->name('category.save');
            Route::get('/edit/{id}', 'CategoryController@edit')->name('category.edit');
            Route::post('/update', 'CategoryController@update')->name('category.update');
            Route::get('/delete/{id}', 'CategoryController@delete')->name('category.delete');
            Route::get('/rebuild', 'CategoryController@rebuild')->name('category.rebuild');
        });
    });


    // attribute router
    Route::group(['prefix' => 'attribute', 'namespace' => 'Attribute'], function () {
        Route::get('/', 'AttributeController@index')->name('attribute');
        Route::get('/create', 'AttributeController@create')->name('attribute.create');
        Route::post('/save', 'AttributeController@save')->name('attribute.save');
        Route::get('/edit/{id}', 'AttributeController@edit')->name('attribute.edit');
        Route::post('/update', 'AttributeController@update')->name('attribute.update');
        Route::get('/delete/{id}', 'AttributeController@delete')->name('attribute.delete');

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
