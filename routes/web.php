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

Route::prefix('guest')->namespace('guest')->name('guest.')->group(function() {
	Route::get('/', 'HomeController@homepage')->name('homepage');
});

// Auth::routes();

Route::prefix('upr')->namespace('upr')->name('upr.')->middleware('auth')->group(function() {
	Route::get('/', 'HomeController@homepage')->name('homepage');
	Route::resource('/homes', 'HomeController');
});