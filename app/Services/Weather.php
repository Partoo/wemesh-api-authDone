<?php

namespace App\Services\Weather;

use Cache;
use GuzzleHttp\Client;

class WeatherClient
{
    public static function get()
    {
        if (Cache::has('weather')) {
            return Cache::get('weather');
        } else {
            $result = static::fetchWeather();
            Cache::put('weather', $result, 300);
            return $result;
        }
    }

    private static function fetchWeather()
    {
        $client = new Client();

        return $client->request('GET', config('wemesh.weather.url'), [
            'headers' => [
                'Authorization' => config('wemesh.weather.appkey')
            ],
            'query' => [
                'city' => config('wemesh.weather.city')
            ]
        ])->getBody()->getContents();
    }
}