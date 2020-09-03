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

Auth::routes();
// Authentication scaffolding
Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('guest')->namespace('guest')->name('guest.')->group(function() {
	Route::get('/', 'HouseController@homepage')->name('homepage');
});

Route::prefix('upr')->namespace('upr')->name('upr.')->middleware('auth')->group(function() {
	Route::get('/', 'HouseController@homepage')->name('homepage');
	Route::resource('/houses', 'HouseController');
});

Route::get('/payments', function () {
    return view('upra.payments.create');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
