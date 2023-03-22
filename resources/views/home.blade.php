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
                <button type="button" class="find-event-button" onclick="window.location='{{ route('event') }}'">{{__('JOIN & RACE FREE')}}</button>
            </div>
        </div>
    </div> 
</div>
<div class="container-fluid">
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
                    <button type="button" class="view-spartan-button" onclick="window.location='{{ route('event') }}'">{{__('VIEW SPARTAN PAGE')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
