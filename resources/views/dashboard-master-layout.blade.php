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
    <link rel="stylesheet" href="{{ mix('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @yield('style-libraries')
    {{-- Font-awesome --}}
    @yield('styles')
</head>

<body style="margin: 0">
    @hasSection('form')
        @yield('form')
    @else
        @include('layouts.admin.header')
        <div class="d-flex dashboard-content row" id="admin">
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
