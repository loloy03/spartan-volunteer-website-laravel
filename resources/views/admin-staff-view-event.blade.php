@extends('layouts.app')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/view-event-and-join-as-volunteer.css') }}">
@endsection

@section('content')
    <div class="container-fluid ">
        <div class="row">

            <div class="col-lg-6 my-auto position-relative">
                <!-- Display the event picture -->
                <div>
                    <img class="w-100" src="/images/events/{{ $event->event_pic }}">
                </div>
                <!-- Add an overlay image on top of the event picture -->
                <img class="overlay-image" src="{{ asset('/images/spartan-logo-with-word.png') }}">
            </div>

            <div class="col-lg-6 p-4 my-auto">
                <div class="f-montserrat">
                    <!-- Date of the event, converted to uppercase -->
                    <div class="text-muted pt-2">{{ strtoupper($date) }}</div>
                    <!-- Title of the event, converted to uppercase -->
                    <div class="display-5 mt-2">{{ strtoupper($event->title) }}</div>
                    <div class="d-inline-block mt-2">
                        <!-- Pin icon to indicate the event location -->
                        <img src="/images/icons/pin-icon.png" style="width:15px">
                        <!-- Location of the event, converted to uppercase -->
                        {{ strtoupper($event->location) }}
                    </div>
                </div>

                {{-- Displaying event discription --}}
                <div class="f-lato my-3">{{ $event->description }}</div>

                @if (Auth::guard('staff')->check())
                    @include ('staff.partials.view-event')
                @elseif (Auth::guard('admin')->check())
                    @include ('admin.partials.view-event')
                @endif
            </div>
        </div>
    </div>
@endsection
