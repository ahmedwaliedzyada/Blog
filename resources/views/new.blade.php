<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <title>{{config('app_name' , 'Blog')}}</title>
</head>
<body>
@include('inc.navbar')
<div class="container">
    @include('inc.message')
    @yield('content')
</div>
<script src="'js/jsm.js'"></script>
</body>
</html>
