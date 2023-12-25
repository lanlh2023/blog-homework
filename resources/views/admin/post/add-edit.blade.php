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
    @include('partial.form.toast-message')
    <div class="col-12 col-xl-10 col-lg-9 col-md-9 content-table">
        <form  enctype='multipart/form-data' id="post-form">
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
                                <x-slot:input value="{{ old('title') }}" name="title">
                                </x-slot:input>
                            </x-form.group-input>
                            <x-form.group-input>
                                <x-slot:div class="mb-3">
                                </x-slot:div>
                                <x-slot:label>
                                    Image title:
                                </x-slot:label>
                                <x-slot:input value="{{ old('image_title') }}" name="image_title" type="file">
                                </x-slot:input>
                            </x-form.group-input>
                            <div class="form-group">
                                <label> Content Title: </label>
                                <textarea class="form-control" placeholder="Enter the Content title" name="content_title" id="content_title"></textarea>
                                <div class="error-div error-content_title">
                                    @if ($errors->has('content_title'))
                                        <label id="content_title-error pt-2" class="error text-danger"
                                            for="content_title">{{ $errors->first('content_title') }}</label>
                                    @endif
                                </div>
                            </div>
                            <select class="form-control category" name="category" id="category">
                                @foreach ($categories as $category)
                                    <option class="" value="{{ $category->id }}">
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-success btn-add-post"> Save </button>
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
        </div>
        @error('error')
            @include('partial.notification.alert-message')
        @enderror
    </div>
    <!--Container Main end-->
@stop

@section('scripts')
    <script src="{{ mix('js/validation/post-validation.js') }}"></script>
    <script src="{{ mix('js/admin/post/add.js') }}"></script>
    @include('includes.loadNotification')
@stop
