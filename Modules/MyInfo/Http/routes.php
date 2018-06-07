<?php

Route::group(['middleware' => 'web', 'prefix' => 'myinfo', 'namespace' => 'Modules\MyInfo\Http\Controllers'], function()
{
    Route::get('/', 'MyInfoController@index');
});
