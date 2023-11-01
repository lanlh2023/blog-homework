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
    <link rel="stylesheet" href="{{ asset('js/libs/fontawesome-free-6.4.2-web/css/all.min.css') }}">
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
