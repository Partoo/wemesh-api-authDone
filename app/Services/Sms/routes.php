<?php


$raw = config('sms.route') ?: 'api/v1/getSms/';

$route = substr($raw, -1) === '/' ? $raw : $raw . '/';
Route::get($route, 'App\Services\Sms\SmsController@fire');