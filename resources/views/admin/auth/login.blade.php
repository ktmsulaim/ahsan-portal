@extends('admin.layout.auth')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-5 navbar-light">
        <a href="index.html" class="navbar-brand flex-column mb-2 align-items-center mr-0" style="min-width: 0">
            <span class="text-primary mr-2">
                <img src="{{ asset('img/Logo.png') }}" width="100" alt="">
            </span>
            <span>Ahsan</span>
        </a>
        <p class="m-0">Log into Admin </p>
    </div>

    <form action="{{ route('admin.login') }}" method="POST" novalidate>
        @csrf
        <div class="form-group">
            <label class="text-label" for="email_2">Email Address:</label>
            <div class="input-group input-group-merge">
                <input id="email_2" type="email" name="email" required="" class="form-control form-control-prepended"
                    placeholder="name@ahsan.org" value="{{ old('email') }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-envelope"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="text-label" for="password_2">Password:</label>
            <div class="input-group input-group-merge">
                <input name="password" id="password_2" type="password" required="" class="form-control form-control-prepended"
                    placeholder="Enter your password">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fa fa-key"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-block btn-primary" type="submit">Login</button>
        </div>
        <div class="form-group text-center">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked="" id="remember">
                <label class="custom-control-label" for="remember">Remember me</label>
            </div>
        </div>
    </form>
@endsection
