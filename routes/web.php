<?php


use App\Order;
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

Route::get('/home','ProductController@index');


/* Basket */

Route::get('/basket', 'BasketController@index');
Route::get('/basket/add/{product}', 'BasketController@add');

/* Order */

Route::get('/order/details', 'OrderController@create');
Route::post('/order/success', 'OrderController@store');

/* Products */

Route::get('/products', 'ProductController@index');
Route::get('/products/create', 'ProductController@create');
Route::post('/products/store', 'ProductController@store');
Route::get('/products/{slug}', 'ProductController@show');
Route::get('/products/{product}/edit', 'ProductController@edit');
Route::put('/products/{product}', 'ProductController@update');
Route::delete('/products/{product}', 'ProductController@destroy');

/* Categories */

Route::get('/categories', 'CategoryController@index');
Route::get('/categories/create', 'CategoryController@create');
Route::post('/categories/store', 'CategoryController@store');
Route::get('/categories/{slug}', 'CategoryController@show');
Route::get('/categories/{category}/edit', 'CategoryController@edit');
Route::delete('/products/{category}', 'CategoryController@destroy');
Route::put('/categories/{category}', 'CategoryController@update');

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
