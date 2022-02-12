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

Route::get('/', function () {
    return view('store.index');
   //return $products;
});
Route::get('/store/products', function () {
    return view('store.products');
   //return $products;
})->name('store.products');
Route::get('/store/products/{id}', 'App\Http\Controllers\Store\ProductsController@show')->name('store.productdetail');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('products', 'App\Http\Controllers\ProductsController');
Route::resource('categories', 'App\Http\Controllers\CategoriesController');
Route::resource('tags', 'App\Http\Controllers\TagsController');
Route::get('/trashProduct/{id}','App\Http\Controllers\ProductsController@trashProduct');
Route::get('/deleteProduct/{id}','App\Http\Controllers\ProductsController@deleteProduct');
Route::get('/restoreProduct/{id}','App\Http\Controllers\ProductsController@restoreProduct');
Route::get('/restoreAllProducts','App\Http\Controllers\ProductsController@restoreAllProducts');
Route::get('/AllTrashedProducts','App\Http\Controllers\ProductsController@AllTrashedProducts');
Route::get('/search','App\Http\Controllers\ProductsController@search');
Route::get('/roles','App\Http\Controllers\ProductsController@useroles');
Route::get('/searchbycategory','App\Http\Controllers\ProductsController@searchbycategory')->name('searchbycategory');
Route::post('/bulkactions','App\Http\Controllers\ProductsController@bulkactions')->name('products.bulkactions');
Route::post('/bulkactionstrash','App\Http\Controllers\ProductsController@bulkactionstrash')->name('products.bulkactionstrash');

Route::get('/cart','App\Http\Controllers\Store\CartController@cart')->name('cart');
Route::post('/addtocart/{id}','App\Http\Controllers\Store\CartController@addtocart')->name('addtocart');
Route::post('/updatecart','App\Http\Controllers\Store\CartController@updatecart')->name('updatecart');
Route::post('/removefromcart','App\Http\Controllers\Store\CartController@removefromcart')->name('removefromcart');
Route::get('/checkout','App\Http\Controllers\Store\OrdersController@checkout')->name('checkout');
Route::post('/createorder','App\Http\Controllers\Store\OrdersController@createorder')->name('createorder');
Route::get('/payment','App\Http\Controllers\Store\PaymentController@payment')->name('payment');
Route::get('/verifypayment/{transaction_id}','App\Http\Controllers\Store\PaymentController@verifypayment')->name('verifypayment');
Route::get('/completepayment', 'App\Http\Controllers\Store\PaymentController@completepayment')->name('completepayment');
Route::get('/thankyou', 'App\Http\Controllers\Store\PaymentController@thankyou')->name('thankyou');

Route::get('orders', 'App\Http\Controllers\Store\OrdersController@index')->name('orders.index');