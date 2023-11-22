@extends('master-layout')

@section('title', 'Blog')

@section('style-libraries')
@stop

@section('styles')
    <link rel="stylesheet" href="{{ mix('css/blog/index.css') }}">
@stop

@section('content')
    <div class="col-12 col-xl-10 col-lg-9 col-md-9 content-table-wrap m-auto">
        <div class="container">
            <div class="" id="content-detail">
                <div class="post-item-content">
                    <h2 class="post-item-title mt-3">{{ $post->title }}</h2>
                    <span class="text-muted">{{ $post->updated_at }}</span>
                    <div class="content-tile mt-2 mb-3 text-content">
                        {{ $post->content_title }}
                    </div>
                    <img src="{{ asset($post->image_title) }}" alt="" class="w-100">
                </div>
                <div id="content-sub-detail">
                    <div class="content-sub-detail-wrap">
                        @foreach ($post->content as $subContent)
                            <div class="text-center image-content">
                                <img src="{{ asset($subContent->image) }}" alt="" class="w-100">
                            </div>
                            <div class="text-content">
                                {!! $subContent->content !!}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="content-detail card shadow" id="content-user-detail-in-show-blog">
                    <div class="card-header w-100 d-dlex flex-column align-items-center">
                        <div class="d-flex justify-content-start">
                            <img class="object-fit-cover rounded-circle border image-user-in-show-blog" src="{{ asset($post->user->avatar) }}" alt="" class="w-100">
                            <div class="ml-3 d-flex flex-column justify-content-around">
                                <h6>By <span class="name-user-in-show-blog">{{ optional($post->user)->name }}</span></h6>
                                <span class="text-break">{{ optional($post->user)->email }}</span>
                                <span class="flex-1 text-muted">Join {{ $post->created_at }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    @if (!is_null(session('message')))
        <script>
            alert("{{ session('message') }}")
        </script>
    @endif
@stop
