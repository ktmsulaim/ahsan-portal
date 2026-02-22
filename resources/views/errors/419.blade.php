@extends('layouts.auth', ['title' => 'Session expired'])

@section('content')
    <div class="login-card__brand">
        <div class="login-card__logo">
            <img src="{{ asset('img/icon.png') }}" alt="Ahsan" width="64" height="64">
        </div>
        <h1 class="login-card__title">Ahsan</h1>
        <p class="login-card__subtitle">Session expired</p>
    </div>

    <p class="text-center text-muted mb-4" style="font-size: 0.9375rem;">
        Your session has expired for security reasons. Please log in again to continue.
    </p>

    <div class="form-group">
        <a class="btn btn-primary btn-block login-form__submit" href="{{ route('login') }}">Log in</a>
    </div>
    <div class="text-center mt-3">
        <a class="login-form__link" href="{{ route('admin.login') }}">Admin login</a>
    </div>
@endsection
