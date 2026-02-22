@extends('layouts.auth', ['title' => 'Login'])

@section('content')
    <div class="login-card__brand">
        <div class="login-card__logo">
            <img src="{{ asset('img/icon.png') }}" alt="Ahsan" width="64" height="64">
        </div>
        <h1 class="login-card__title">Ahsan</h1>
        <p class="login-card__subtitle">Log in to your account</p>
    </div>

    <form action="{{ route('login') }}" method="POST" autocomplete="on" class="login-form">
        @csrf
        <div class="form-group">
            <label class="login-form__label" for="email">Email address</label>
            <div class="input-group login-form__input">
                <div class="input-group-prepend">
                    <span class="input-group-text"><span class="far fa-envelope"></span></span>
                </div>
                <input id="email" type="email" required name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="yourname@email.com" autocomplete="email" inputmode="email" spellcheck="false">
            </div>
            @error('email')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="login-form__label" for="password">Password</label>
            <div class="input-group login-form__input">
                <div class="input-group-prepend">
                    <span class="input-group-text"><span class="fa fa-key"></span></span>
                </div>
                <input id="password" type="password" name="password" required
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Enter your password" autocomplete="current-password">
            </div>
            @error('password')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block login-form__submit" type="submit">Login</button>
        </div>
        <div class="form-group login-form__remember">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked name="remember" id="remember">
                <label class="custom-control-label" for="remember">Remember me</label>
            </div>
        </div>
        <div class="login-form__footer text-center">
            <p class="mb-1"><a href="{{ route('password.request') }}" class="login-form__link">Forgot password?</a></p>
            <p class="mb-0"><a href="{{ route('membership.apply') }}" class="login-form__link">Don't have an account? Apply</a></p>
        </div>
    </form>
@endsection
