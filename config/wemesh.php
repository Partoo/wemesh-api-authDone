<?php

return [
    'site_name' => '维脉事-WeMesh',
    'meta' => [
        'keywords' => 'WeMesh,维脉事,青岛世达奥科网络技术有限公司,办公一体化',
        'description' => '维脉事-Wemesh是一套旨在解决各行业办公一体化的软件'
    ],
    'default_avatar' => env('DEFAULT_AVATAR') ?: '/img/avatar.png',
    'favicon' => env('FAVICON') ?: '/favicon.ico',
    'plugin_namespace_root' => env('PLUGIN_NAMESPACE_ROOT') ?: 'App\\Plugins\\',
    'weather' => [
        'url' => 'http://jisutqybmf.market.alicloudapi.com/weather/query',
        'appkey' => 'APPCODE f95f761e60e7478e83803875cf3e1164',
        'city' => '胶州市'
    ]
];