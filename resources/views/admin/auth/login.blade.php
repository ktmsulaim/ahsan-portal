@extends('admin.layout.auth')

@section('content')
    <div class="login-card__brand">
        <div class="login-card__logo">
            <img src="{{ asset('img/icon.png') }}" alt="Ahsan" width="64" height="64">
        </div>
        <h1 class="login-card__title">Ahsan</h1>
        <p class="login-card__subtitle">Log into Admin</p>
    </div>

    <form action="{{ route('admin.login') }}" method="POST" autocomplete="on" class="login-form">
        @csrf
        <div class="form-group">
            <label class="login-form__label" for="email_2">Email address</label>
            <div class="input-group login-form__input">
                <div class="input-group-prepend">
                    <span class="input-group-text"><span class="far fa-envelope"></span></span>
                </div>
                <input id="email_2" type="email" name="email" required
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="name@ahsan.org" value="{{ old('email') }}" autocomplete="email">
            </div>
            @error('email')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="login-form__label" for="password_2">Password</label>
            <div class="input-group login-form__input">
                <div class="input-group-prepend">
                    <span class="input-group-text"><span class="fa fa-key"></span></span>
                </div>
                <input id="password_2" type="password" name="password" required
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
    </form>
@endsection
