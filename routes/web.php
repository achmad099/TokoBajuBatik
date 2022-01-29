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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::name('admin.')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('products', 'Admin\ProductController');

        Route::resource('orders', 'Admin\OrderController');
    });
});

// view image routes
Route::get('image/view/{fileImage}', 'Admin\ProductController@viewImage')->name('admin.products.image');

Route::get('/products', 'ProductController@index')->name('products.index');
Route::get('/products/{id}', 'ProductController@show')->name('products.show');
Route::get('/products/image/{imageName}', 'ProductController@image')->name('products.image');
// product view
Route::post('/products/review/store/{product_id}', 'ProductController@storeReview')->name('products.review');
Route::get('/products/review/{product_id}', 'ProductController@getReview')->name('products.index.review');

Route::get('/carts', 'CartController@index')->name('carts.index');
Route::get('/carts/add/{id}', 'CartController@add')->name('carts.add');
Route::patch('carts/update', 'CartController@update')->name('carts.update');
Route::delete('carts/remove', 'CartController@remove')->name('carts.remove');

Route::get('/payment/{total}', 'CartController@payment')->name('payment');
