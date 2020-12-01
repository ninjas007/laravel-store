<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', 'Client\HomeController@index');
Route::get('/home', 'Client\HomeController@index');
Route::get('/category/{slug}', 'Client\CategoryController@index');
Route::get('/product/{slug}', 'Client\ProductController@index');
Route::get('/cart', 'Client\CartController@index');
Route::get('/checkout', 'Client\CheckoutController@index');
Route::get('/checkout-success/{code_order}', 'Client\CheckoutController@success');
Route::get('/invoice/{code_order}', 'Client\CheckoutController@invoice');
// Route::get('test', 'Client\HomeController@pdf1');
// Route::get('test-pdf', 'Client\HomeController@pdf');

Route::prefix('api')->group(function() {
	Route::get('cart', 'Client\Api\CartController@index');
	Route::post('cart/store', 'Client\Api\CartController@store');
	Route::post('cart/update', 'Client\Api\CartController@update');
	Route::get('cart/remove', 'Client\Api\CartController@destroy');
	Route::get('region/cities', 'Client\Api\RegionController@cities');
	
	Route::get('shippingMethods', 'Client\Api\ShippingController@shippingMethods');
	Route::post('setShippingMethod', 'Client\Api\ShippingController@setShippingMethod');
	Route::get('courierCost', 'Client\Api\CourierController@cost');
	Route::get('getPayments', 'Client\Api\CheckoutController@getPayments');
	Route::post('checkoutOrder', 'Client\Api\CheckoutController@checkoutOrder');
});

Route::prefix('admin')->group(function() {	
	Route::get('dashboard', 'Admin\DashboardController@index');
	// Route products
	Route::prefix('products')->group(function() {
		Route::get('/', 'Admin\ProductController@index');
		Route::get('add', 'Admin\ProductController@create');
		Route::post('store', 'Admin\ProductController@store');
		Route::get('edit/{id}', 'Admin\ProductController@edit');
		Route::put('update/{id}', 'Admin\ProductController@update');
		Route::get('delete', 'Admin\ProductController@destroy');
	});
	// Route categories
	Route::prefix('categories')->group(function() {
		Route::get('/', 'Admin\CategoryController@index');
		Route::get('add', 'Admin\CategoryController@create');
		Route::post('store', 'Admin\CategoryController@store');
		Route::get('edit/{id}', 'Admin\CategoryController@edit');
		Route::put('update/{id}', 'Admin\CategoryController@update');
		Route::get('delete', 'Admin\CategoryController@destroy');
	});
	// Route payments
	Route::prefix('payments')->group(function() {
		Route::get('/', 'Admin\PaymentController@index');
		Route::get('edit/{id}', 'Admin\PaymentController@edit');
		Route::put('update/{id}', 'Admin\PaymentController@update');
	});
	// Route shippings
	Route::prefix('shippings')->group(function() {
		Route::get('/', 'Admin\ShippingController@index');
		Route::get('edit/{id}', 'Admin\ShippingController@edit');
		Route::put('update/{id}', 'Admin\ShippingController@update');
	});
	// Route file manager
	Route::group(['prefix' => 'laravel-filemanager'], function () {
	    \UniSharp\LaravelFilemanager\Lfm::routes();
	});
});

Route::get('session', function () {
    // Store a piece of data in the session...
    session([
    	'shipping_method' => [
    		'shipping_code' => 'shipping_rajaongkir',
    		'provice_id' => 1,
    		'city_id' => 1
    	],
    ]);
});

Route::get('session-get', function(Request $request) {
	$data = $request->session()->all();

	dd($data);
});