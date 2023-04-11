@extends('layouts.app')

@section('import-css')
    <link rel="stylesheet" href="{{ asset('/css/home.css') }}">
@endsection

@section('content')
    <div class="home-pic">
        <div class="container-fluid">
            <img src="{{ asset('/images/spartan-home-pic.jpg') }}" alt="home-pic">
            <div class="text-overlay">
                <div class="f-montserrat display-4 transparent-text">
                    {{ __('BE A VOLUNTEER NOW') }}
                </div>
                <div class="f-montserrat float-start mt-2">
                    <button type="button" class="find-event-button"
                        onclick="window.location='{{ route('event') }}'">{{ __('JOIN & RACE FREE') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="p-5">
            <div class="display-5 f-montserrat mb-3">VOLUNTEER PERKS</div>
            <div class="f-lato">Along with the awesome feeling of helping your fellow Spartans, there are some sweet perks
                to being a Spartan Volunteer.
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="p-4">
                        <img class="home-card-pic" src="{{ asset('/images/spartan-home-card-pic-1.jpg') }}" alt="home-pic">
                        <div class="f-lato">
                            Free entry to a volunteer heat in a Sprint 5K, City 5K, Stadion 5K, Super 10K or Beast 21K in
                            the
                            Philippines
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="p-4">
                        <img class="home-card-pic" src="{{ asset('/images/spartan-home-card-pic-2.jpg') }}" alt="home-pic">
                        <div class="f-lato">A free Spartan volunteer t-shirt, snacks and festival entry on the day you
                            volunteer. </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="p-4">
                        <img class="home-card-pic" src="{{ asset('/images/spartan-home-card-pic-3.jpg') }}" alt="home-pic">
                        <div class="f-lato">
                            An exclusive behind-the-scenes look at how Spartan races operate and being part of changing
                            lives
                            around the world.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="home-pic">
        <img src="{{ asset('/images/spartan-home-pic-dark.jpg') }}" alt="home-pic">
        <div class="text-overlay">
            <div class="f-montserrat display-6">
                {{ __('MEET NEW PEOPLE BEING A PART OF THE TEAM, SOCIALIZING AND EARNING A FREE RACE,') }}
            </div>
            <div class="f-montserrat float-start mt-2">
                <button type="button" class="find-event-button"
                    onclick="window.location='{{ route('event') }}'">{{ __('COMMIT NOW') }}</button>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="p-5">
            <div class="row">
                <div class="col-lg-5">
                    <img src="{{ asset('/images/spartan-home-pic2.jpg') }}" alt="">
                    <div class="text-overlay">
                        <div class="f-montserrat display-6">
                            {{ __('BECOME UNBREAKABLE') }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 p-5 my-auto">
                    <div class="f-montserrat">
                        <div class="display-5">
                            {{ __('ABOUT SPARTAN RACE') }}
                        </div>
                        <div class="h4 mt-4 text-danger">
                            {{ __('SPARTAN MISSION') }}
                        </div>
                        <div class="f-lato h5">
                            <div class="mt-4">
                                {{ __('Every human can become unbreakable. They’ve simply forgotten how. We deconstruct modern-day comforts by tapping into an ancient methodology built on doing hard shit.') }}
                            </div>
                            <div class="mt-4">
                                {{ __('Every human can become unbreakable. They’ve simply forgotten how. We deconstruct modern-day comforts by tapping into an ancient methodology built on doing hard shit.') }}
                            </div>
                            <div class="mt-4">
                                {{ __('Every human can become unbreakable. They’ve simply forgotten how. We deconstruct modern-day comforts by tapping into an ancient methodology built on doing hard shit.') }}
                            </div>
                        </div>
                        <div class="my-4">
                            <button type="button" class="view-spartan-button"
                                onclick="window.location='{{ route('event') }}'">{{ __('VIEW SPARTAN PAGE') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid h-100">
        <div class="p-5">
            <div class="display-5 f-montserrat mb-3 ">HAVE A QUESTION?</div>
            <div class="f-lato my-3">
                Need an answer to a question? Contact us at
                <div class="d-inline-block">
                    <p><a href="mailto:volunteer@spartanrace.com">volunteer@spartanrace.com</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
