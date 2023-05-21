@extends('layouts.app')

@section('import-css')
<link rel="stylesheet" href="{{ asset('/css/staff/staff-auth.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5">
        <!--ADD IMAGE BACKGROUND HERE-->
        <div class="contents">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12">
                        <div class="form-block mx-auto">
                            <div class="text-center mb-5 fw-bold fs-3 f-montserrat">
                                <h3>STAFF LOGIN</h3>
                            </div>
                            <form action="/staff-login" method="POST" class="f-lato">
                                @csrf
                                <div class="form-group first">
                                    <label for="username">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" value ="{{ old ('email')}}">

                                    @error("email")
                                        <p class="text-danger text-xs mt-1">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>
                                <div class="form-group last mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password">

                                    @error("password")
                                        <p class="text-danger text-xs mt-1">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>

                                <div class="d-sm-flex mb-5 align-items-center">
                                    <label class="control mb-3 mb-sm-0">
                                        <input class="checkbox mr-2" type="checkbox" checked="checked" />
                                        <span class="caption">Remember me</span>
                                    </label>
                                    <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                                </div>

                                <input type="submit" value="Log In" class="submit-button mt-2 f-montserrat btn-lg">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
