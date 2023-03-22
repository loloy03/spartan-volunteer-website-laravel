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

                <div class="box-border-shadow p-3 two-color-in-div">
                    <div class="d-flex justify-content-between f-montserrat">
                        <div class=" text-muted">BE A VOLUNTEER</div>
                        <div class="fs-13">{{ strtoupper($event_start_date) . ' - ' . strtoupper($event_end_date) }}</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="f-montserrat fs-4">JOIN AS VOLUNTEER</div>
                        <div class="f-lato mb-auto text-muted text-end fs-10">START AND END DATE OF REGISTRATION</div>
                    </div>

                    <div class="d-flex justify-content-between {{ $attendance_status == 'joining' ? 'd-none' : '' }}">
                        <!-- Display the status of the event -->
                        <div
                            class="text-success f-lato mb-auto fs-13 {{ $event_status == 'NOT AVAILABLE' || $event_status == 'VOLUNTEER CANCELLED' ? ' text-danger' : '' }}">
                            STATUS: {{ $event_status }}
                        </div>

                        <!-- Form to join the event as a volunteer -->
                        <form method="POST" action="{{ route('volunteer_status.store') }}">
                            @csrf
                            <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                            <input type="hidden" name="volunteer_fullname"
                                value="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}">
                            <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                            <button type="submit"
                                class="my-auto view-event-btn f-montserrat {{ $event_status == 'NOT AVAILABLE' || $event_status == 'VOLUNTEER CANCELLED' ? 'view-event-btn-disabled' : '' }}"
                                {{ $event_status == 'NOT AVAILABLE' || $event_status == 'VOLUNTEER CANCELLED' ? 'disabled' : '' }}>
                                Join Now
                            </button>
                        </form>
                    </div>

                    <div class="{{ $attendance_status != 'joining' ? 'd-none' : '' }}">
                        <!-- Registration confirmation status -->
                        <div class="d-flex justify-content-between mt-2">
                            <div
                                class="text-success f-lato my-auto fs-13 {{ $event_status == 'NOT AVAILABLE' ? 'text-danger' : '' }}">
                                STATUS: {{ strtoupper($attendance_status) }}
                            </div>
                            <!-- Confirm registration button -->
                            <form method="POST" action="{{ route('volunteer_status.confirmed') }}">
                                @csrf
                                <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                                <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                <!-- Cancel registration button -->
                                <button
                                    class="my-auto view-event-btn f-montserrat">
                                    Confirm Registration
                                </button>
                            </form>
                        </div>

                        <!-- Registration confirmation info and cancel button -->
                        <div class="d-flex justify-content-between pt-1">
                            <div class="f-lato mb-auto text-muted text-start fs-10 w-25">TO BE PART OF THE TEAM YOU NEED TO
                                CONFIRM REGISTRATION</div>

                            <form method="POST" action="{{ route('volunteer_status.cancelled') }}">
                                @csrf
                                <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                                <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                <!-- Cancel registration button -->
                                <button
                                    class="my-auto view-event-btn f-montserrat {{ $event_status == 'NOT AVAILABLE' ? 'view-event-btn-disabled' : '' }}"
                                    {{ $event_status == 'NOT AVAILABLE' ? 'disabled' : '' }}>
                                    Cancel Registration
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

                {{-- Section for claiming code --}}
                <div class="box-border-shadow p-3 two-color-in-div mt-3 {{ $attendance_status == 'joining' ? 'd-none' : '' }}">
                    <div class="d-flex justify-content-between f-montserrat">
                        <div class=" text-muted">GET FREE RACE</div>
                        <div class="fs-13">{{ strtoupper($code_start_date) . ' - ' . strtoupper($code_end_date) }}</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="f-montserrat fs-4">CLAIM CODE</div>
                        <div class="f-lato mb-auto text-muted text-end fs-10">START AND END DATE OF CLAIMING CODE</div>
                    </div>
                    <div class="d-flex justify-content-between ">
                        <div
                            class="text-success f-lato mb-auto fs-13 {{ $code_status == 'NOT AVAILABLE' ? 'text-danger' : '' }}">
                            STATUS: {{ $code_status }}
                        </div>
                        <button
                            class="my-auto view-event-btn f-montserrat {{ $code_status == 'NOT AVAILABLE' || $attendance_status == 'joining' ? 'view-event-btn-disabled' : '' }}"
                            {{ $code_status == 'NOT AVAILABLE' ? 'disabled' : '' }}>Claim Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection
