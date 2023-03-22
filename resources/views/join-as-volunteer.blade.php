@extends('layouts.app')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/view-event-and-join-as-volunteer.css') }}">
@endsection

@section('content')
    <div class="container-fluid ">
        <div class="row my-5">
            <div class="col-lg-6 my-auto position-relative">
                <!-- Display the event picture -->
                <div>
                    <img class="w-100" src="/images/events/{{ $event->event_pic }}">
                </div>
                <!-- Add an overlay image on top of the event picture -->
                <img class="overlay-image" src="{{ asset('/images/spartan-logo-with-word.png') }}">
            </div>

            <div class="col-lg-6 p-4">
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

                <div class="box-border-shadow-bt-red p-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class=" text-muted d-inline-block fs-10 ">{{ strtoupper($date) }} </div>
                            <div class=" text-success d-inline-block f-lato fs-10 mx-3"> STATUS:
                                {{ strtoupper($attendance_status) }}
                            </div>
                            <div class="f-montserrat fs-4">JOINED AS VOLUNTEER</div>
                            <div class="f-montserrat mb-auto fs-13 pb-3">
                                ROLE: <em> {{ strtoupper($role ?? 'no role assigned yet') }} </em>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="text-muted fs-10 f-montserrat ">PLEASE CHECK IN AND CHECK OUT IN THE DAY OF THE
                                EVENT
                            </div>
                            <div class="mt-2">
                                <button
                                    class="my-auto view-event-btn f-montserrat {{ $event->date != $today ? 'view-event-btn-disabled' : '' }}"
                                    {{ $event->date != $today ? 'disabled' : '' }}>
                                    Check In
                                </button>
                                <button
                                    class="my-auto view-event-btn f-montserrat {{ $event->date != $today ? 'view-event-btn-disabled' : '' }}"
                                    {{ $event->date != $today ? 'disabled' : '' }}>
                                    Check Out
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="text-mute w-75 mx-auto"><hr></div>
                        <div class="f-montserrat fs-5">MY VOLUNTEER INFO</div>
                        <div class="px-4">
                            <div class="f-montserrat mt-1">CHECKED IN TIME:</div>
                        </div>
                        <div class="px-4">
                            <div class="f-montserrat mt-1">CHECKED OUT TIME:</div>
                        </div>
                        <div class="px-4">
                            <div class="f-montserrat mt-1">PHOTO IN THE EVENT:</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
