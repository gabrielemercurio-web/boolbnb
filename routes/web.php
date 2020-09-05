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

//guest routes
Route::get('/', 'HouseController@homepage')->name('guest.homepage');
Route::get('/search', 'HouseController@search')->name('guest.search');
Route::get('/houses/{house}', 'HouseController@show')->name('guest.show');

//UPR routes
Route::prefix('upr')->namespace('upr')->name('upr.')->middleware('auth')->group(function() {
	Route::get('/', 'HouseController@homepage')->name('houses.homepage');
	Route::get('/search', 'HouseController@search')->name('houses.search');
	Route::resource('/houses', 'HouseController');
	Route::get('/payments', 'PaymentController@index')->name('payments.index');
	Route::get('/payments', 'PaymentController@create')->name('payments.create');
    Route::post('/payments', 'PaymentController@store')->name('payments.store');
    Route::get('/messages', 'MessageController@index')->name('messages.index');
	Route::get('/stats', 'HitController@index')->name('hits.index');
	Route::get('/stats', 'MessageController@index')->name('messages.index');
});
