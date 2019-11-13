<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="shortcut icon" href="{{ asset('images/logo.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        <!-- Sử dụng component Example.vue -->
        <router-view></router-view>
    </div>
    
    <script src="{{mix('js/app.js')}}"></script>
</body>
</html>
