@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <label class="text-label" for="email_2">Email Address:</label>
                                <div class="input-group input-group-merge">
                                    <input id="email_2" type="email" required="" name="email"
                                        value="{{ request()->query('email') ?? old('email') }}"
                                        class="form-control form-control-prepended @error('email') is-invalid @enderror"
                                        placeholder="yourname@email.com" autofocus>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="far fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                {{-- @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback d-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="text-label" for="password_2">Password:</label>
                                <div class="input-group input-group-merge">
                                    <input id="password_2" type="password" name="password" required=""
                                        class="form-control form-control-prepended" placeholder="Enter your password">
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
                            
                            <div class="form-group">
                                <label class="text-label" for="password_2">Confirm Password:</label>
                                <div class="input-group input-group-merge">
                                    <input id="password_2" type="password" name="password_confirmation" required=""
                                        class="form-control form-control-prepended" placeholder="Confirm password">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fa fa-key"></span>
                                        </div>
                                    </div>
                                </div>

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback d-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Reset Password') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
