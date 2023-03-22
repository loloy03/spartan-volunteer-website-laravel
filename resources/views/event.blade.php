@extends('layouts.app')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/event.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5">
        <!-- Page Title -->
        <div class="f-montserrat display-6 ">
            {{ __('AVAILABLE EVENTS') }}

        </div>
        <div class="row">
            @foreach ($events as $event)
                <div class="col-lg-6 f-montserrat p-2">
                    <div class="bg-light-gray">
                        <!-- Image Button - on click redirect to view-event page -->
                        <button class="image-container"
                            onclick="window.location='{{ route('view-event', $event->event_id) }}'">
                            <img src="/images/events/{{ $event->event_pic }}" class="fixed-size-img">
                            <!-- Image Text Overlay -->
                            <div class="image-text ">
                                <p class="fs-6">{{ strtoupper($event->date) }}</p>
                            </div>
                        </button>

                        <!-- Event Details -->
                        <div class="p-4">
                            <div class="d-block fs-4">
                                {{ strtoupper($event->title) }}
                            </div>
                            <div class="d-inline-block fs-10 pt-4">
                                <img src="/images/icons/pin-icon.png" width="15px">
                                {{ strtoupper($event->location) }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
