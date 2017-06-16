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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


// catalog router
Route::group([/*'prefix' => 'catalog',*/ 'namespace' => 'Catalog'], function () {
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index')->name('frontend.category');
        Route::get('/{id}', 'CategoryController@info')->name('frontend.category.info');
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', 'ProductController@index')->name('frontend.product');
        Route::get('/{id}', 'ProductController@info')->name('frontend.product.info');
    });
});

