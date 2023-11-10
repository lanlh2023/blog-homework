@extends('dashboard-master-layout')

@section('title', 'Dashboard')

@section('style-libraries')
@stop

@section('styles')
    <link rel="stylesheet" href="{{ mix('css/message/alert-message.css') }}">
@endsection

@section('content')
    <!--Container Main start-->
    <div class="col-12 col-xl-10 col-lg-9 col-md-9 content-table">
        <form action="{{ route('admin.post.store') }}" method="POST">
            @csrf
            <div class="row mt-3">
                <div class="col-12 m-auto">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="card-title"> {{ $pageTitle }} </h4>
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
                                <label> Content </label>
                                <textarea class="form-control" id="content" placeholder="Enter the Content" name="content"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success"> Save </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @error('error')
            @include('partial.notification.alert-message')
        @enderror
        <form action="" id="form-add-images">
            @csrf
            <div class="row mt-3">
                <div class="col-xl-6 col-lg-6 col-sm-12 col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="card-title"> Add images </h4>
                        </div>
                        <div class="card-body">
                            <x-form.group-input>
                                <x-slot:div class="mb-3">
                                </x-slot:div>
                                <x-slot:label>
                                    Image :
                                </x-slot:label>
                                <x-slot:input value="{{ old('image') }}" name="image" type="file">
                                </x-slot:input>
                            </x-form.group-input>
                            <div class="form-group">
                                <label> Description </label>
                                <textarea class="form-control" id="description" placeholder="Enter the Description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-add-images"> Add </button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-sm-12 col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="card-title"> Show images </h4>
                        </div>
                        <div class="card-body d-flex flex-column list-image">
                            @include('admin.post.load-images')
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--Container Main end-->
@stop

@section('scripts')
    <script src="{{ asset('js/admin/post/add.js') }}"></script>
    @if (!is_null(session('message')))
        <script>
            alert("{{ session('message') }}")
        </script>
    @endif
@stop
