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
    @php
        $route = '/admin/user/store';
        if (!empty($user)) {
            $route = "/admin/user/update/$user->id";
        }
    @endphp
    <div class="col-12 col-xl-10 col-lg-9 col-md-9 content-table">
        @include('partial.form.toast-message')
        {{-- <form enctype='multipart/form-data' id="register-form" method="POST" action="{{ $route }}">
            @csrf
            <div class="row mt-3">
                <div class="col-12 m-auto">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="card-title"> {{ $pageTitle ?? 'Add edit user' }} </h4>
                        </div>
                        <div class="card-body">
                            <x-form.group-input>
                                <x-slot:div class="mb-3">
                                </x-slot:div>
                                <x-slot:label>
                                    Email:
                                </x-slot:label>
                                <x-slot:input value="{{ old('email', $user['email'] ?? '') }}" name="email">
                                </x-slot:input>
                            </x-form.group-input>
                            <x-form.group-input>
                                <x-slot:div class="mb-3">
                                </x-slot:div>
                                <x-slot:label>
                                    Name:
                                </x-slot:label>
                                <x-slot:input value="{{ old('name', $user['name'] ?? '') }}" name="name">
                                </x-slot:input>
                            </x-form.group-input>
                            <x-form.group-input>
                                <x-slot:div class="mb-3">
                                </x-slot:div>
                                <x-slot:label>
                                    Avatar:
                                </x-slot:label>
                                <x-slot:input value="{{ old('name', $user['name'] ?? '') }}" name="avatar"
                                    type="file">
                                </x-slot:input>
                            </x-form.group-input>
                            <x-form.group-input>
                                <x-slot:div class="mb-3">
                                </x-slot:div>
                                <x-slot:label>
                                    Password:
                                </x-slot:label>
                                <x-slot:input type="password" value="{{ old('password') }}" name="password">
                                </x-slot:input>
                            </x-form.group-input>
                            <x-form.group-input>
                                <x-slot:div class="mb-3">
                                </x-slot:div>
                                <x-slot:label>
                                    Password Confirmation:
                                </x-slot:label>
                                <x-slot:input name="password_confirmation"
                                    value="{{ old('password__confirmation') }}" type="password">
                                </x-slot:input>
                            </x-form.group-input>
                            @if (!empty($user))
                                <input type="text" hidden id="userID" value="{{ $user->id }}">
                            @endif
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-add-post"> Save </button>
                        </div>
                    </div>
                </div>
            </div>
        </form> --}}
        <add-edit-user/>
        @error('error')
            @include('partial.notification.alert-message')
        @enderror
    </div>
    <!--Container Main end-->
@stop

@section('scripts')
    <script src="{{ mix('js/validation/form-validation.js') }}"></script>
    @include('includes.loadNotification')
@stop
