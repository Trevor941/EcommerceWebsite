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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('products', 'App\Http\Controllers\ProductsController');
Route::resource('categories', 'App\Http\Controllers\CategoriesController');
Route::get('/trashProduct/{id}','App\Http\Controllers\ProductsController@trashProduct');
Route::get('/deleteProduct/{id}','App\Http\Controllers\ProductsController@deleteProduct');
Route::get('/restoreProduct/{id}','App\Http\Controllers\ProductsController@restoreProduct');
Route::get('/restoreAllProducts','App\Http\Controllers\ProductsController@restoreAllProducts');
Route::get('/AllTrashedProducts','App\Http\Controllers\ProductsController@AllTrashedProducts');
Route::get('/search','App\Http\Controllers\ProductsController@search');
Route::get('/roles','App\Http\Controllers\ProductsController@useroles');