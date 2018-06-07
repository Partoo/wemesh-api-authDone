<!DOCTYPE html>
<html lang="utf-8">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="author" content="Partoo">
    <meta name="description" content="微脉事 - 企事业单位办公一体化系统">
    <meta name="keywords" content="wemesh,微脉事,办公一体化">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wemesh-微脉事</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="{{mix('css/app.css')}}">
</head>
<body>
<div id="app">

    <div class="overlay vcenter">
        <div class="overlay_mask"></div>
        <div class="overlay_content">
            <div class="card fluid">
                <div class="card-header section">
                    <logo class="center"></logo>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ mix('js/mini.js') }}"></script>
</body>
</html>

