@extends('dashboard-master-layout')

@section('title', 'Dashboard')

@section('style-libraries')
@stop

@section('styles')
    <link rel="stylesheet" href="{{ mix('css/message/alert-message.css') }}">
    <link rel="stylesheet" href="{{ mix('css/admin/post.css') }}">
@endsection

@section('content')
    <!--Container Main start-->
    <div class="col-12 col-xl-10 col-lg-9 col-md-9 content-table">
        @include('partial.form.toast-message')
        <form enctype='multipart/form-data' id="post-form">
            @csrf
            <div class="row mt-3">
                <div class="col-12 m-auto">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="card-title"> {{ $pageTitle ?? 'Add edit post' }} </h4>
                        </div>
                        <div class="card-body">
                            <x-form.group-input>
                                <x-slot:div class="mb-3">
                                </x-slot:div>
                                <x-slot:label>
                                    Title :
                                </x-slot:label>
                                <x-slot:input value="{{ old('title', $post->title ?? '') }}" name="title">
                                </x-slot:input>
                            </x-form.group-input>
                            <x-form.group-input>
                                <x-slot:div class="mb-3">
                                </x-slot:div>
                                <x-slot:label>
                                    Image title:
                                </x-slot:label>
                                <x-slot:input value="{{ old('image_title', $post->image_title ?? '') }}"
                                    src="{{ $post->image_title }}" name="image_title" type="file">
                                </x-slot:input>
                            </x-form.group-input>
                            <div class="form-group">
                                <label> Content Title: </label>
                                <textarea class="form-control" placeholder="Enter the Content title" name="content_title" id="content_title">{{ old('content_title', trim($post->content_title) ?? '') }}</textarea>
                                <div class="error-div error-content_title">
                                    @if ($errors->has('content_title'))
                                        <label id="content_title-error pt-2" class="error text-danger"
                                            for="content_title">{{ $errors->first('content_title') }}</label>
                                    @endif
                                </div>
                            </div>
                            <select class="form-control category" name="category" id="category">
                                @foreach ($categories as $category)
                                    <option class="" value="{{ $category->id }}"
                                        {{ isset($category->id) && $category->id == optional($post->category)->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-success btn-update-post"> Save </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-12 col-xl-6 col-lg-6 col-md-12">
                <form enctype='multipart/form-data' id="image-form">
                    <div class="row mt-3">
                        <div class="col-12 m-auto">
                            <div class="card shadow">
                                <div class="card-header">
                                    <h4 class="card-title"> Add sub image</h4>
                                </div>
                                <div class="card-body">
                                    <x-form.group-input>
                                        <x-slot:div class="mb-3">
                                        </x-slot:div>
                                        <x-slot:label>
                                            File :
                                        </x-slot:label>
                                        <x-slot:input value="{{ old('file') }}" name="file" type="file">
                                        </x-slot:input>
                                    </x-form.group-input>
                                    <div class="form-group">
                                        <label> Content: </label>
                                        <textarea class="form-control" style="min-height: 300px" id="content" placeholder="Enter the Content" name="content"></textarea>
                                        <div class="error-div error-content">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-success" id="add-image"> Save </button>
                                    <button type="button" class="btn btn-warning" id="update-subcontent" disabled> update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-xl-6 col-lg-6 col-md-12 mt-3">
                <div class="content-detail card shadow" style="min-height: 600px" id="content-detail">
                    <div class="card-header">
                        <h4 class="card-title"> Show sub image</h4>
                    </div>
                    <div id="content-detail-list">
                    </div>
                </div>
            </div>
            <textarea name="post-content" id="post-content" cols="30" rows="10" hidden>  {{ json_encode($post->content) }}</textarea>
            <input type="text" hidden id="post-id" value="{{ $post->id }}">
        </div>
    </div>
    <!--Container Main end-->
@stop
@section('scripts')
    <script src="{{ mix('js/admin/post/update.js') }}"></script>
    <script src="{{ mix('js/admin/post/delete.js') }}"></script>
@stop
