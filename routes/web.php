<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Client\Pages\HomeController@index');
Route::get('/home', 'Client\Pages\HomeController@index');
Route::get('category/{slug}', 'Client\Pages\CategoryController@index');
Route::get('product/{slug}', 'Client\Pages\ProductController@index');
Route::get('cart', 'Client\Pages\CartController@index');
Route::get('checkout', 'Client\CheckoutController@checkout');

Route::prefix('api')->group(function() {
	Route::get('cart', 'Client\Api\CartController@index');
	Route::post('cart/store', 'Client\Api\CartController@store');
	Route::post('cart/update', 'Client\Api\CartController@update');
	Route::get('cart/remove', 'Client\Api\CartController@destroy');
});

Route::prefix('admin')->group(function() {	
	Route::get('dashboard', 'Admin\DashboardController@index');
	// Route products
	Route::prefix('products')->group(function() {
		Route::get('/', 'Admin\ProductController@index');
		Route::get('add', 'Admin\ProductController@create');
		Route::post('store', 'Admin\ProductController@store')->name('admin.products-store');
		Route::get('edit/{id}', 'Admin\ProductController@edit');
		Route::put('update/{id}', 'Admin\ProductController@update');
		Route::get('delete', 'Admin\ProductController@destroy');
	});
	// Route categories
	Route::prefix('categories')->group(function() {
		Route::get('/', 'Admin\ProductCategoryController@index');
		Route::get('add', 'Admin\ProductCategoryController@create');
		Route::post('store', 'Admin\ProductCategoryController@store')->name('admin.categories-store');
		Route::get('edit/{id}', 'Admin\ProductCategoryController@edit');
		Route::put('update/{id}', 'Admin\ProductCategoryController@update');
		Route::get('delete', 'Admin\ProductCategoryController@destroy');
	});
	// Route file manager
	Route::group(['prefix' => 'laravel-filemanager'], function () {
	    \UniSharp\LaravelFilemanager\Lfm::routes();
	});
});