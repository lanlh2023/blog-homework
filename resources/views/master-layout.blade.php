<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', config('app.name', '@Master Layout'))</title>
    <!-- <title>{{ $pageTitle ?? ''}}</title> -->
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--Styles css common--}}
    <link rel="stylesheet" href="{{ mix('css/app.css')}}">

    @yield('style-libraries')

    {{-- Google Font: Source Sans Pro --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    {{--Styles custom--}}
    @yield('styles')</head>
<body>
    @hasSection('form')
        @yield('form')
    @else
        @include('partial.header')
        @yield('content')
        @include('partial.footer')
    @endif
    @include('includes.scripts')
     {{--Script custom--}}
    @yield('scripts')
</body>
</html>
