@extends('dashboard-master-layout')

@section('title', 'Dashboard')

@section('style-libraries')
@stop

@section('styles')
    <link rel="stylesheet" href="{{ mix('css/admin/user.css') }}">
@stop

@section('content')
    <!--Container Main start-->
    @include('partial.form.toast-message')
    <user-list path="{{ url()->current() }}" />
    <!--Container Main end-->
@stop
@section('scripts')
    @include('includes.loadNotification')
@stop
