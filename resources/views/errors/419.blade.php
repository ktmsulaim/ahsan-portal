@extends('layouts.auth')

@section('content')
    <div class="d-flex justify-content-center mt-2 mb-5 navbar-light">
        <a href="{{ url('/') }}" class="navbar-brand" style="min-width: 0">
            <img class="navbar-brand-icon" src="{{ asset('img/Logo.png') }}" width="25" alt="Ahsan Logo">
            <span>AHSAN</span>
        </a>
    </div>

    <h4 class="m-0">Session expired</h4>
    <p class="mb-4">Your session has expired for security reasons. Please log in again to continue.</p>

    <div class="form-group text-center">
        <a class="btn btn-primary mb-2" href="{{ route('login') }}">Log in</a>
        <p class="mb-0 mt-3">
            <a class="text-body text-underline" href="{{ route('admin.login') }}">Admin login</a>
        </p>
    </div>
@endsection
