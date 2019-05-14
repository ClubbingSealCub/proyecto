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

//Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');

Route::get('/additem', 'PagesController@additem');

Route::get('user/{userID?}', function($userID=null) {
    return $userID;
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/home', '/user');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');