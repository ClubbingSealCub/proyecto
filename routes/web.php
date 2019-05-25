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

Route::get('additem', ['uses' => 'FamiliaController@getAllFamilies']);

Route::get('items/additem', ['uses' => 'ArticuloController@store']);

Route::get('create_bid', ['uses' => 'ArticuloController@fetch']);

Route::get('item/{id?}', ['uses' => 'ArticuloController@show']);

Route::get('user/{userID?}', ['uses' => 'UserController@show']);

Route::get('bidsearch', ['uses' => 'FamiliaController@getAllFamiliesSearch']);

Route::post('search', ['uses' => 'ArticuloController@SearchByTerms']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
