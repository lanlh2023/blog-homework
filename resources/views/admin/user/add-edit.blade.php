@extends('dashboard-master-layout')

@section('title', 'Dashboard')

@section('style-libraries')
@stop

@section('styles')
    <link rel="stylesheet" href="{{ mix('css/message/alert-message.css') }}">
    <link rel="stylesheet" href="{{ mix('css/admin/user.css') }}">
@endsection

@section('content')
    <!--Container Main start-->
    <div class="col-12 col-xl-10 col-lg-9 col-md-9 content-table">
        @include('partial.form.toast-message')
        <add-edit-user id="{{ !empty($user) ? $user->id : null }}"> </add-edit-user>
        @error('error')
            @include('partial.notification.alert-message')
        @enderror
    </div>
    <!--Container Main end-->
@stop

@section('scripts')
    @include('includes.loadNotification')
@stop
