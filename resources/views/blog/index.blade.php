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
            <div class="post-list d-flex flex-column align-items-center">
                @foreach ($posts as $postItem)
                    <a href="{{ route('blog.show', ['id' => $postItem->id]) }}" class="text-reset">
                        <div class="post-item border shadow">
                            <div class="image-post-item w-100 mb-2">
                                <img src="{{ asset($postItem->image_title) }}" alt="">
                            </div>
                            <div class="post-item-content">
                                <h4 class="post-item-title mt-3">
                                    {{ $postItem->title }}
                                </h4>
                                <p class="post-item-content-title">
                                    {{ $postItem->content_title }}
                                </p>
                            </div>
                            <div class="footer-info d-flex justify-content-between align-items-center">
                                <div class="info-user d-flex align-items-center">
                                    <img src="{{ asset($postItem->user->avatar) }}" class="rounded" alt=""
                                        height="40px" width="40px">
                                    <span class="text-muted ml-2">{{ $postItem->user->name }}</span>
                                </div>
                                <div>
                                    <span class="text-muted">{{ $postItem->updated_at }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @if (!empty($posts))
                <div class="pagination-wrap d-flex justify-content-end px-4 pt-4">
                    {{ $posts->withQueryString()->links('vendor.pagination.basic') }}
                </div>
            @endif
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
