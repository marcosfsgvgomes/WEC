<?php
use Vinkla\Hashids\Facadaes\Hashids;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/wec', 'WecController@index')->name('wec');

Route::get('/wec/show', 'WecController@show')->name('wec.show');

Route::post('/wec/inspect', 'WecController@store')->name('wec.inspect');

Route::get('/wec/show/filter', 'WecController@filter')->name('wec.show.filter');

Route::get('/find', function () {
    return view('wec.update');
})->name('wec.find');

Route::get('/wec/find/{id}', 
[
    'as' => 'wec.find/{id}',
    'uses' => 'WecController@find',
]);

Route::get('/customer/print-pdf', [ 'as' => 'customer.printpdf', 'uses' => 'PdfController@printPDF']);

Route::get('admin', 'Admin\CategoryController@index');

Route::resource('wec', 'WecController',
    array('except' => array('create', 'update', 'edit', 'destroy', 'show')));

Route::fallback(function (){
    return abort(404);

});
