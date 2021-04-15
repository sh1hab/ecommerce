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

//Route::get('/', function () {
//    return view('welcome');
//});

use App\Http\Controllers\Frontend\HomeController;

Auth::routes();

Route::group(['namespace'=>'Frontend'],function(){
    //    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/','HomeController')->name('home');
    Route::get('/product/{slug}', 'ProductController@showDetails')->name('product.details');

    Route::post('/cart/add','CartController@addToCart')->name('cart.add');

    Route::delete('/delete','CartController@deleteFromCart')->name('cart.delete');

    Route::get('/cart/show','CartController@showCart')->name('cart.show');

    Route::get('/about','HomeController@about')->name('about');

});
