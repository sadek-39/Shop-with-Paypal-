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

// Route::get('/', function () {
//     return view('welcome');
// });

 Route::redirect('/','/home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add-to-cart/{product}', 'CardController@add')->name('cart.add')->middleware('auth');
Route::get('/cart', 'CardController@index')->name('cart.show')->middleware('auth');
Route::get('/cart/delete/{itemId}', 'CardController@delete')->name('cart.delete')->middleware('auth');
Route::get('/cart/update/{itemId}', 'CardController@update')->name('cart.update')->middleware('auth');
Route::get('/checkout', 'CardController@check')->name('checkout');

Route::resource('orders','OrderController')->middleware('auth');

Route::get('paypal/checkout/{order}', 'PaypalController@getExpressCheckout')->name('paypal.checkout');
Route::get('paypal/checkoutsuccess/{order}', 'PaypalController@getExpressCheckoutSuccess')->name('paypal.checkoutsuccess');
Route::get('paypal/checkoutcancel', 'PaypalController@cancelpayment')->name('paypal.checkoutcancel');


