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

Route::get('/', 'SiteController@index')->name('index');


Route::group(['prefix' => 'painel'], function () {
    Route::get('/home','HomeController@dashboard')->name('home');
    Route::resource('vehicles', 'VehicleController')->middleware('auth');
});

Route::group(['prefix' => 'api'], function () {
    Route::get('/{id}/{method}',['uses' => 'VehicleController@APIshow'])->name('api');
    Route::post('login/{email}/{pwd}', 'Auth\LoginController@authenticate')->name('log');
});


Auth::routes();

