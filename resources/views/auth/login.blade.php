@extends('layouts.app')

@section('import-css')
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
@endsection

@section('content')
    <div class="container-fluid ">
        <div class="row">
            <div class="col-lg-4 p-5 d-flex align-items-center ">

                <div class="mx-auto">


                    <div class="text-center">
                        <img width="100" src="{{ asset('/images/spartan-logo-favicon.png') }}" alt="login pic">
                    </div>

                    <div class="fw-bold fs-3 f-montserrat">
                        {{ __('LOG IN AS VOLUNTEER') }}
                    </div>

                    <form method="POST" action="{{ route('login') }}">

                        @csrf

                        <div class="mt-4 f-lato">
                            <!--email-->
                            <label for="email">{{ __('Email Address') }}</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-4 f-lato">
                            <!--password-->
                            <label for="password">{{ __('Password') }}</label>

                            <input id="password" type="password"
                                class="form-control 
                    @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-2 f-montserrat">
                            <button type="submit" class="submit-button">
                                {{ __('Login') }}
                            </button>
                        </div>

                        <div class="mt-2 f-lato">
                            <div class="text-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" class="text-center" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 my-auto">
                <img id="loginPic" src="{{ asset('/images/spartan-login-pic.jpg') }}" alt="login pic">
            </div>
        </div>
    </div>
@endsection
