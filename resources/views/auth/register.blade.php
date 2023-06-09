@extends('layouts.app')

@section('import-css')
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-8 ">
                <img src="{{ asset('/images/spartan-register-pic.jpg') }}" alt="">
            </div>

            <div class="col-lg-4 p-5 my-auto">

                <div class="fw-bold fs-4 f-montserrat">
                    REGISTER AS VOLUNTEER
                </div>


                <form method="POST" action="{{ route('register') }}">

                    @csrf

                    <!--first name input-->
                    <div class="mt-3 f-lato ">

                        <label for="first_name">{{ __('First Name') }}</label>

                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                            name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!--last name input-->
                    <div class="mt-3 f-lato">

                        <label for="last_name">{{ __('Last Name') }}</label>

                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                            name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!--email-->
                    <div class="mt-3 f-lato">
                        <label for="email">{{ __('Email Address') }}</label>


                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mt-3 f-lato">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            @if ($message == 'The password field format is invalid.')
                                <div class="mt-2" style="height: 2rem; overflow-y: auto; display:block;">
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>The password must contain 8 characters and include a combination of uppercase
                                            letters, lowercase letters, numbers, and symbols.</strong>
                                    </span>
                                </div>
                            @else
                                <div class="mt-2" style="height: 1rem; overflow-y: auto;">
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                            @endif
                        @enderror
                    </div>

                    <div class="mt-3 f-lato">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>




                    <div class="mt-1 f-montserrat">
                        <button type="submit" class="submit-button">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
