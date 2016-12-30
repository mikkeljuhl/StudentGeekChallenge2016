<?php


use App\Order;
use App\Product;


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

Route::get('/', function(){
}


);


Auth::routes();

Route::get('/','CategoryController@index');
Route::get('/home','ProductController@index');

Route::get('/auth/overview', 'AccountController@show');
Route::post('/auth/overview', 'AccountController@update');

/* Search */

Route::post('/products/search', 'SearchController@search');

/* Basket */

Route::get('/basket', 'BasketController@index');
Route::get('/basket/add/{product}', 'BasketController@add');

/* Order */

Route::get('/orders/details', 'OrderController@create');
Route::post('/orders/success', 'OrderController@store');
Route::get('/orders/overview', 'OrderController@index');
Route::get('/orders/overview/{order}', 'OrderController@show');

/* Shipping methods */

Route::get('/shipping/methods/', "ShippingMethodController@index");
Route::get('/shipping/methods/create', "ShippingMethodController@create");
Route::post('/shipping/methods/store', "ShippingMethodController@store");
Route::get('/shipping/methods/{method}/edit', "ShippingMethodController@edit");
Route::put('/shipping/methods/{method}', "ShippingMethodController@update");

/* Products */

//ADMIN
Route::get('/products/create', 'ProductController@create');
Route::post('/products/store', 'ProductController@store');
Route::get('/products/{product}/edit', 'ProductController@edit');
Route::put('/products/{product}', 'ProductController@update');
Route::delete('/products/{product}', 'ProductController@destroy');

Route::get('/products', 'ProductController@index');
Route::get('/products/{slug}', 'ProductController@show');

/* Categories */

// ADMIN
Route::get('/categories/create', 'CategoryController@create');
Route::post('/categories/store', 'CategoryController@store');
Route::get('/categories/{category}/edit', 'CategoryController@edit');
Route::delete('/products/{category}', 'CategoryController@destroy');
Route::put('/categories/{category}', 'CategoryController@update');


Route::get('/categories', 'CategoryController@index');
Route::get('/categories/{slug}', 'CategoryController@show');


/* Attributes */

Route::get('/attributes', 'AttributeController@index');
Route::get('/attributes/create', 'AttributeController@create');
Route::post('/attributes/store', 'AttributeController@store');
Route::get('/attributes/{attribute}/edit', 'AttributeController@edit');
Route::put('/attributes/{attribute}', 'AttributeController@update');

/* Attribute relations */
Route::get('/attribute/relations', 'AttributeRelationController@index');
Route::get('/attribute/relations/create', 'AttributeRelationController@create');
Route::post('/attribute/relations/store', 'AttributeRelationController@store');
Route::get('/attribute/relations/{attribute}/edit', 'AttributeRelationController@edit');
Route::put('/attribute/relations/{attribute}', 'AttributeRelationController@update');


/* Facebook login */
Route::get('/fb', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');
