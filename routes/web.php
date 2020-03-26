<?php
use Vinkla\Hashids\Facadaes\Hashids;
use Illuminate\Support\MessageBag;
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

/* Middleware that verifies if the user is authenticated.
If not, the user is redirect to the login screen.*/
Route::middleware('auth')->group(function () {
    Route::get('/wec', 'WecController@index')->name('wec');
    Route::get('/wec/show', 'WecController@show')->name('wec.show');
    Route::get('/wec/show/filter', 'WecController@filter')->name('wec.show.filter');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::post('/authentication', 'Auth\LoginController@authenticate');

Route::post('/register', 'Auth\RegisterController@store');

Route::post('/registration', 'Auth\RegisterController@registration');

Route::get('/anonymous/index', function () {
    return view('anonymous.index');
})->name('anonymous/index');

Route::post('/wec/inspect', 'WecController@store')->name('wec.inspect');

Route::post('/anonymous/inspect', 'WecController@storeAnon')->name('anonymous/inspect');

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


