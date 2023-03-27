@extends('layouts.auth')

@section('content')
    <div class="d-flex justify-content-center mt-2 mb-5 navbar-light">
        <a href="index.html" class="navbar-brand" style="min-width: 0">
            <img class="navbar-brand-icon" src="{{ asset('img/Logo.png') }}" width="25" alt="Ahsan Logo">
            <span>AHSAN</span>
        </a>
    </div>

    <h4 class="m-0">Welcome back!</h4>
    <p class="mb-5">Login to access your Account</p>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="text-label" for="email_2">Email Address:</label>
            <div class="input-group input-group-merge">
                <input id="email_2" type="email" required="" name="email" value="{{ old('email') }}" class="form-control form-control-prepended"
                    placeholder="yourname@email.com">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-envelope"></span>
                    </div>
                </div>
            </div>

            @if ($errors->has('email'))
                <span class="invalid-feedback d-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="text-label" for="password_2">Password:</label>
            <div class="input-group input-group-merge">
                <input id="password_2" type="password" name="password" required="" class="form-control form-control-prepended"
                    placeholder="Enter your password">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fa fa-key"></span>
                    </div>
                </div>
            </div>

            @if ($errors->has('password'))
                <span class="invalid-feedback d-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group mb-5">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked="" name="remember" id="remember">
                <label class="custom-control-label" for="remember">Remember me</label>
            </div>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary mb-5" type="submit">Login</button><br>
            <p>Forgot password? <a class="text-body text-underline" href="{{ route('password.request') }}">Reset here</a></p>
            <p>Don't have an account? <a class="text-body text-underline" href="{{ route('membership.apply') }}">Apply!</a></p>
        </div>
    </form>
@endsection
