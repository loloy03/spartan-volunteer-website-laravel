@extends('layouts.app')

@section('import-css')
<link rel="stylesheet" href="{{ asset('/css/login.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 p-5 my-auto">
           
            <div class="fw-bold fs-4 f-montserrat mb-4">{{ __('Verify Your Email Address') }}</div>

            <div class="f-lato">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                </form>
            </div>
        </div>
        <div class="col-lg-8">
            <img src="{{ asset('/images/spartan-verify-pic.png') }}" alt="">
        </div>
    </div>
</div>
@endsection
