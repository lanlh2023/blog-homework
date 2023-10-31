<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageTitle ?? '' }}</title>
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Styles css common --}}
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">

    @yield('style-libraries')
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.css') }}">
    {{-- Font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Google Font: Source Sans Pro --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    {{-- Styles custom --}}
    @yield('styles')
</head>

<body>
    @hasSection('form')
        @yield('form')
    @else
        @include('layouts.admin.header')
        <div class="d-flex dashboard-content row">
            @include('layouts.admin.sidebar')
            @yield('content')
        </div>
        @include('layouts.admin.footer')
    @endif
    @include('includes.scripts')
    {{-- Script custom --}}
    @yield('scripts')
</body>

</html>
