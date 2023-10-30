@extends('master-layout')

@section('title', 'Blog')

@section('style-libraries')
@stop

@section('styles')
@stop

@section('content')
    <div class="container">
        <h1>home</h1>
    </div>
@stop
@section('scripts')
    @if (!is_null(session('message')))
        <script>
            alert("{{ session('message') }}")
        </script>
    @endif
@stop
