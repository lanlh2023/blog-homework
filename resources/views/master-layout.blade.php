<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <title>{{ $pageTitle ?? ''}}</title> -->
    <title>@yield('title', config('app.name', '@Master Layout'))</title>
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--Styles css common--}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.css') }}">
    @yield('style-libraries')

    {{--Styles custom--}}
    @yield('styles')
    
    {{-- Google Font: Source Sans Pro --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
</head>
<body>
    @hasSection('form')
        @yield('form')
    @else
        @include('partial.header')
        @yield('content')
        @include('partial.footer')
    @endif
    {{-- @include('includes.scripts') --}}
    <script src="{{ asset('js/libs/jquery/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/libs/jquery/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ asset('js/libs/jquery/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/libs/jquery/jquery-validation/custom-method.js') }}"></script>
    <script src="{{ asset('js/libs/jquery/jquery-validation/custom-message.js') }}"></script>
    <script src="{{ asset('js/libs/bootstrap/js/bootstrap.js') }}"></script>
    @yield('jquery')
</body>
</html>