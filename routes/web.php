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

Route::resource('products', 'ProductController', ['only' => ['index', 'show', 'create']]);

Route::post('products/store', 'ProductController@store')->name('product.store');
Route::get('products/store', 'ProductController@store')->name('product.store');


Route::post('products/update', 'ProductController@update');
Route::get('products/edit/{id}', 'ProductController@edit');


Route::post('products/delete/{id}', 'ProductController@destroy');
