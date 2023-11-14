@extends('dashboard-master-layout')

@section('title', 'Dashboard')

@section('style-libraries')
@stop

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/post.css') }}">
@stop

@section('content')
    <!--Container Main start-->
    <div class="col-12 col-xl-10 col-lg-9 col-md-9 content-table-wrap">
        <div class="content-detail card shadow" id="content-detail">
            <div class="card-header">
                <h1 class="card-title">{{ $post->title }}</h1>
                <img src="{{ asset($post->image_title) }}" alt="" class="w-100">
                <div class="content-tile mt-2">
                    {{ $post->content_title }}
                </div>
            </div>
            <div id="content-sub-detail">
                <div class="p-3">
                    @foreach ($post->content as $subContent)
                        <div class="text-center">
                            <img src="{{ asset($subContent->image) }}" alt="" class="w-100">
                        </div>
                        <div class="m-2">
                            {{ $subContent->content }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <button class="btn btn-danger btn-delete mt-3"><svg xmlns="http://www.w3.org/2000/svg" height="1.25em"
                viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path
                    d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
            </svg>
            delete
        </button>
    </div>
    <!--Container Main end-->
    @include('partial.form.delete-confirmation', ['model' => $post])
@stop

@section('scripts')
    @if (!is_null(session('message')))
        <script>
            alert("{{ session('message') }}")
        </script>
    @endif
    <script src="{{ mix('js/admin/post/delete.js') }}"></script>
@stop
