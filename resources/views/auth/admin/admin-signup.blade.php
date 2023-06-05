@extends('layouts.app')

@section('import-css')
<link rel="stylesheet" href="{{ asset('/css/admin/admin-auth.css') }}">
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
                                <h3>ADMIN SIGNUP</h3>
                            </div>
                            <form action="/admin-signup" method="POST" class="f-lato">
                                @csrf
                                <div class="form-group first mb-2">
                                    <label for="first-name">First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" value ="{{ old ('first_name')}}" required>

                                    @error("first_name")
                                        <p class="text-danger text-xs mt-1">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>
                                <div class="form-group second mb-2">
                                    <label for="last-name">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name" value ="{{ old ('last_name')}}" required>

                                    @error("last_name")
                                        <p class="text-danger text-xs mt-1">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>
                                <div class="form-group third mb-2">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" value ="{{ old ('email')}}" required>

                                    @error("email")
                                        <p class="text-danger text-xs mt-1">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>
                                <div class="form-group last mb-2">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" required>

                                    @error("password")
                                        <p class="text-danger text-xs mt-1">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>
                                <div class="form-group last mb-3">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                                </div>

                                {{-- <div class="d-sm-flex mb-5 align-items-center">
                                    <label class="control mb-3 mb-sm-0">
                                        <input class="checkbox mr-2" type="checkbox"/>
                                        <span class="caption">Remember me</span>
                                    </label>
                                    <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                                </div> --}}

                                <input type="submit" value="Sign Up" class="submit-button mt-2 f-montserrat btn-lg">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection