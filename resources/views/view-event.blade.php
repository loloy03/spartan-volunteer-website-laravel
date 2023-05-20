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
                @else
                    <div class="box-border-shadow p-3 two-color-in-div">
                        <div class="d-flex justify-content-between f-montserrat">
                            <div class=" text-muted">BE A VOLUNTEER</div>
                            <div class="fs-13">{{ strtoupper($event_start_date) . ' - ' . strtoupper($event_end_date) }}
                            </div>
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
                                    <button class="my-auto view-event-btn f-montserrat">
                                        Confirm Registration
                                    </button>
                                </form>
                            </div>

                            <!-- Registration confirmation info and cancel button -->
                            <div class="d-flex justify-content-between pt-1">
                                <div class="f-lato mb-auto text-muted text-start fs-10 w-25">TO BE PART OF THE TEAM YOU NEED
                                    TO
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
                    <div
                        class="box-border-shadow p-3 two-color-in-div mt-3 {{ $attendance_status == 'joining' ? 'd-none' : '' }}">
                        <div class="d-flex justify-content-between f-montserrat">
                            <div class=" text-muted">GET FREE RACE</div>
                            <div class="fs-13">{{ strtoupper($code_start_date) . ' - ' . strtoupper($code_end_date) }}
                            </div>
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
                                {{ $code_status == 'NOT AVAILABLE' ? 'disabled' : '' }} data-bs-toggle="collapse"
                                data-bs-target="#view" aria-controls="navbarSupportedContent" aria-expanded="false"
                                aria-label="{{ __('Toggle navigation') }}">See Races</button>

                        </div>
                        <div class="mt-4 collapse" id="view">
                            <div class="f-montserrat">
                                AVAILABLE RACES
                            </div>

                            <div class="f-lato text-muted fs-10 mb-2">PICK ONLY ONE RACE TO CLAIM CODE</div>
                            <div class="d-block">
                                <div class="f-lato text-muted fs-10  d-inline-block">YOUR RACE CREDITS: </div>
                                <div class="f-lato text-muted fs-10 d-inline-block ">{{ Auth::user()->r_credits }}</div>
                            </div>
                            <div
                                class="f-lato text-muted fs-10 mb-2 text-warning {{ Auth::user()->r_credits != 0 ? 'd-none' : '' }}">
                                <div class="text-danger"> YOU DONT HAVE ENOUGH RACE CREDITS </div>
                            </div>

                            <div class="f-lato mt-1">
                                <form method="POST" action="{{ route('claim_code.store_race') }}">
                                    @csrf

                                    @foreach ($races as $race)
                                        <div>
                                            <input type="radio" name="race_id" value="{{ $race->race_id }}"
                                                id="{{ $race->race_id }}">
                                            <label for="{{ $race->race_type }}">{{ strtoupper($race->race_type) }}</label>
                                        </div>
                                        <div id="dropdownDiv_{{ $race->race_id }}" style="display: none;">
                                            @for ($i = 1; $i <= 10; $i++)
                                                @if ($race->race_id == $i)
                                                    {{ $r_credit_value - $race->price }}
                                                    {{ $race->price }}
                                                @endif
                                            @endfor

                                        </div>
                                    @endforeach

                                    <script>
                                        // JavaScript/jQuery
                                        $(document).ready(function() {
                                            $('input[name="race_type"]').on('change', function() {
                                                var selectedRaceType = $(this).val();
                                                $('[id^="dropdownDiv_"]').hide(); // Hide all dropdown divs
                                                $('#dropdownDiv_' + selectedRaceType)
                                                    .show(); // Show the specific dropdown div for the selected race type
                                            });
                                        });
                                    </script>


                                    <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                                    <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                    <div class="f-montserrat mt-4">
                                        <button type="submit" {{ Auth::user()->r_credits == 0 ? 'disabled' : '' }}
                                            class=" view-event-btn {{ Auth::user()->r_credits == 0 ? 'view-event-btn-disabled' : '' }} ">Claim
                                            Race</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
