@extends('dashboard-master-layout')

@section('title', 'Dashboard')

@section('style-libraries')
@stop

@section('styles')
    <link rel="stylesheet" href="{{ mix('css/admin/user.css') }}">
@stop

@section('content')
    <!--Container Main start-->
    <div class="col-12 col-xl-10 col-lg-9 col-md-9 content-table-wrap">
        @if (!empty($user))
            <show-user id="{{ $user->id }}"></show-user>
        @endif
    </div>
    <!--Container Main end-->
@stop

@section('scripts')
    <script src="{{ mix('js/admin/post/delete.js') }}"></script>
@stop
