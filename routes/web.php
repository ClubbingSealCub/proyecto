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

//Route::resource('articulo', 'ArticuloController' );
//Route::get('/', 'PagesController@index');

Route::get('/', ['uses' => 'ArticuloController@index']);

Route::get('additem', ['uses' => 'FamiliaController@getAllFamilies'])->name('addItem');

Route::get('items/additem', ['uses' => 'ArticuloController@store']);

Route::get('item/{id}', ['uses' => 'ArticuloController@show'])->name('showItem');

Route::get('user/{userID}', ['uses' => 'UserController@show'])->name('user');

Route::view('/messages', 'pages/messages')->name('showMessages'); 

Route::post('createbid', ['uses' => 'PujaController@create'])->name('createBid');

// Route::post('payment', ['uses' => 'ArticuloController@checkValidity'])->name('payment');
// Route::view('payment', 'payment', ['name' => 'payment']);
Route::post('payment', ['uses' => 'ArticuloController@checkValidity'])->name('payment');

Route::get('payitem', ['uses' => 'ArticuloController@pay'])->name('payItem');

Route::get('bidsearch', ['uses' => 'FamiliaController@getAllFamiliesSearch'])->name('bidSearch');

Route::get('search', ['uses' => 'ArticuloController@searchByTerms'])->name('search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
