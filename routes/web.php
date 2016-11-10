<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/payment-details', [
    'as'   => 'paymentDetails',
    'uses' => 'HomeController@paymentDetails'
]);
Route::post('/subscribe', 'HomeController@subscribe');
Route::get('/premium', [
    'as'         => 'premium',
    'uses'       => 'HomeController@premium',
    'middleware' => ['premiumBlocker']
]);

Route::group(['middleware' => ['premiumBlocker']], function ($route) {
    $route->get('/cancel', 'HomeController@cancelPlan')->name('cancel');
    $route->get('/switch', 'HomeController@switchPlan')->name('switch');
    $route->resource('joke', 'JokesController');
});

