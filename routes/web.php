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

Route::get('/home', 'Client\PagesController@home')->name('home');
Route::get('/', 'Client\PagesController@home');

Route::prefix('admin')->group(function () {
	
	Route::get('dashboard', 'Admin\DashboardController@index');
	// Route products
	Route::prefix('products')->group(function() {
		Route::get('/', 'Admin\ProductController@index');
		Route::get('add', 'Admin\ProductController@create');
		Route::post('store', 'Admin\ProductController@store')->name('admin.categories-store');
		Route::get('edit/{id}', 'Admin\ProductController@edit');
		Route::put('update/{id}', 'Admin\ProductController@update');
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
});