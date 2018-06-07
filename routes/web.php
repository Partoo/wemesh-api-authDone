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

Route::get('/', function () {
    return view('welcome');
});

//AUTH
//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('login', 'Auth\LoginController@login');
//Route::get('logout', 'Auth\LoginController@logout');
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::get('reset', 'Auth\RegisterController@showResetForm');

//WECHAT AUTH
//Route::group(['prefix' => 'auth/wx'], function () {
//    Route::get('/', 'Auth\AuthController@redirectToProvider');
//    Route::get('callback', 'Auth\AuthController@handleProviderCallback');
//    Route::get('register', 'Auth\AuthController@create');
//    Route::post('register', 'Auth\AuthController@store');
//});

Route::get('/{any}', 'HomeController@index')->where('any', '.*');