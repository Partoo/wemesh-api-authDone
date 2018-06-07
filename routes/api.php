<?php

use App\Services\Weather\WeatherClient;
use function foo\func;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1'], function () {
//    AUTH
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::post('refresh', 'AuthController@refresh')->middleware('laravel.jwt');
        Route::post('logout', 'AuthController@logout')->middleware('laravel.jwt');
        Route::post('reset', 'AuthController@reset')->name('reset');
    });

//    DASHBOARD
    Route::group(['prefix' => 'home', 'middleware' => 'jwt'], function () {
        Route::post('me', 'MeController@profile')->name('me');
    });

//    SMS
    Route::get('getSms', '\App\Services\Sms\SmsController@sendAuthcode')->name('getSms');
//    WEATHER
    Route::get('weather', function () {
        return WeatherClient::get();
    });

});