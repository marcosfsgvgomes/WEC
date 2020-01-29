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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('wec', function () {
    return view('wec');
});

Route::get('/wec/show/{id}', function ($id) {
    return 'WEC id nº:' .$id;
});

Route::get('wec/error', function () {
    return view('error');
});

Route::get('wec/update', 'WecController@update');

Route::post('wec/show', 'WecController@store');

Route::resource('wec', 'WecController');
