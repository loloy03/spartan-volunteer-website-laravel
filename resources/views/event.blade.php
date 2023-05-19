@extends('layouts.app')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/event.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5">
        <div class="f-druk-wide display-6">
            @if ($picked_sort == 'RECENT EVENTS')
                {{ __('RECENTS EVENTS') }}
            @else
                {{ __('AVAILABLE EVENTS') }}
            @endif
        </div>

        <div class="f-montserrat my-3">
            <div class="d-inline-block">SORT BY:</div>
            <form method="GET" action="{{ route('event') }}" class="d-inline-block">
                <select name="sort_by" onchange="this.form.submit()">
                    <option value="" disabled selected> {{ $picked_sort }} </option>
                    <option value="avail_events">AVAILABLE EVENTS</option>
                    <option value="date_asc">DATE (WILL START SOON)</option>
                    <option value="date_desc">DATE (NEWEST FIRST)</option>
                    <option value="title_asc">TITLE (A-Z)</option>
                    <option value="title_desc">TITLE (Z-A)</option>
                    <option value="recent_events">RECENT EVENTS</option>
                </select>
            </form>
        </div>

        <div class="row">
            @if ($events->count() > 0)
                @foreach ($events as $event)
                    <div class="col-lg-6 f-montserrat p-2">
                        <div class="bg-light-gray">
                            <!-- Image Button - on click redirect to view-event page -->
                            <button class="image-container"
                                @if (Auth::check()) onclick="window.location='{{ route('view-event', $event->event_id) }}'"> 
                            @else 
                                onclick="window.location='{{ route('login') }}'"> @endif
                                <img src="/images/events/{{ $event->event_pic }}" class="fixed-size-img">
                                <!-- Image Text Overlay -->
                                <div class="image-text p-2">
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
            @else
                <div class="col-lg-12 f-montserrat p-2 mt-5">
                    <div class="bg-light-gray text-center">
                        <p class="fs-4 pt-4 pb-4">NO EVENTS AVAILABLE</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
