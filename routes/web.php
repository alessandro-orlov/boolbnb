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

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('/about', function () {
    return view('about');
})->name('about');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'ApartmentController@search')->name('search');


Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function() {
        Route::resource('apartments', 'ApartmentController');
        Route::get('/messages/{apartment}', 'MessageController@show')->name('message.show');
        Route::delete('/messages/{message}', 'MessageController@destroy')->name('message.destroy');
        Route::get('/visits/{apartment}', 'VisitController@show')->name('visits.show');
        Route::get('/payment/{apartment}', 'PaymentController@index')->name('payment.index');
        Route::post('/payment/{apartment}/checkout', 'PaymentController@checkout')->name('payment.checkout');
        Route::get('/payment/{apartment}/transaction', 'PaymentController@transaction')->name('payment.transaction');
    });
Route::prefix('guest')
    ->name('guest.')
    ->group(function() {
        Route::resource('apartments', 'ApartmentController');
    });
