@extends('master-layout')
@section('title')
    {{ $pageTitle ?? '' }}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/message/alert-message.css') }}">
@endsection
@section('form')
    <div class=" my-3 col-5 justify-content-center d-flex align-items-center" style="margin: auto; height: 100vh">
        <form method="POST" action={{ route('checkRegister') }} id="register-form" style="width: 100%; position: relative;"
            class="border border-light py-3 px-3 form-submit">
            @csrf
            <h1 class="login-tiltle text-center">{{ $pageTitle }}</h1>
            <x-form.group-input>
                <x-slot:div class="mb-3">
                </x-slot:div>
                <x-slot:label>
                    Email:
                </x-slot:label>
                <x-slot:input value="{{ old('email') }}" name="email">
                </x-slot:input>
            </x-form.group-input>
            <x-form.group-input>
                <x-slot:div class="mb-3">
                </x-slot:div>
                <x-slot:label>
                    Name:
                </x-slot:label>
                <x-slot:input value="{{ old('name') }}" name="name">
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
                <x-slot:input name="password_confirmation" value="{{ old('password__confirmation') }}"
                    type="password">
                </x-slot:input>
            </x-form.group-input>
            <button type="submit" class="btn btn-primary">Register</button>
            @error('error')
                @include('partial.notification.alert-message')
            @enderror
        </form>
    @endsection
    @section('scripts')
        <script src="{{ asset('js/validation/form-validation.js') }}"></script>
    @endsection
