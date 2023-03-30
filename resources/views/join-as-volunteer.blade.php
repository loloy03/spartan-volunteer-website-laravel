@extends('layouts.app')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/view-event-and-join-as-volunteer.css') }}">
@endsection

@section('content')
    <div class="container-fluid ">
        <div class="row my-5 p-3">
            <div class="col-lg-6 my-auto">

                <div class="f-montserrat ">

                    <div class="d-inline-block mt-2">
                        <!-- Pin icon to indicate the event location -->
                        <img src="/images/icons/pin-icon.png" style="width:15px">
                        <!-- Location of the event, converted to uppercase -->
                        {{ strtoupper($event->location) }}
                    </div>
                    <!-- Title of the event, converted to uppercase -->
                    <div class="display-5 mt-2">{{ strtoupper($event->title) }}</div>

                    {{-- Displaying event discription --}}
                    <div class="f-lato my-3">{{ $event->description }}</div>
                </div>
                <div class="position-relative mb-4">
                    <!-- Display the event picture -->
                    <div>
                        <img class="w-100" src="/images/events/{{ $event->event_pic }}">
                    </div>
                    <!-- Add an overlay image on top of the event picture -->
                    <img class="overlay-image" src="{{ asset('/images/spartan-logo-with-word.png') }}">
                    <div class="overlay-text">
                        <div class="f-montserrat bg-danger text-light p-2">
                            SECCESSFULLY JOINED AS A VOLUNTEER
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 p-4 my-auto">
                <div class="box-border-shadow-bt-red p-3">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class=" text-muted d-inline-block fs-10 ">{{ strtoupper($date) }} </div>
                            <div class=" text-success d-inline-block f-lato fs-10 mx-3"> STATUS:
                                {{ strtoupper($attendance_status) }}
                            </div>
                            <div class="f-montserrat fs-4">JOINED AS VOLUNTEER</div>
                            <div class="f-montserrat mb-auto fs-13 pb-3">
                                ROLE: <em> {{ strtoupper($role ?? 'no role assigned yet') }} </em>
                            </div>

                        </div>
                        <div class="col-lg-5 {{ $date > $event->date ? 'd-none' : '' }}">
                            <div class="text-muted fs-10 f-montserrat ">PLEASE CHECK IN AND CHECK OUT IN THE DAY OF THE
                                EVENT
                            </div>
                            <div class="mt-4">
                                <div class="d-inline-block">
                                    <form method="POST" action="{{ route('join_as_volunteer.check_in') }}">
                                        @csrf
                                        <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                                        <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                        <!-- Cancel registration button -->
                                        <button type="submit"
                                            class="view-event-btn f-montserrat {{ $event->date != $today ? 'view-event-btn-disabled' : '' }}"
                                            {{ $event->date != $today ? 'disabled' : '' }}>
                                            Check In
                                        </button>
                                    </form>
                                </div>
                                <div class="d-inline-block">
                                    <form method="POST" action="{{ route('join_as_volunteer.check_out') }}">
                                        @csrf
                                        <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                                        <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                        <!-- Cancel registration button -->
                                        <button type="submit"
                                            class="view-event-btn f-montserrat {{ $event->date != $today ? 'view-event-btn-disabled' : '' }}"
                                            {{ $event->date != $today ? 'disabled' : '' }}>
                                            Check Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" {{ $check_in == null ? 'd-none' : '' }}">
                        <div class="text-mute w-75 mx-auto">
                            <hr>
                        </div>
                        <div class="my-3">
                            <div class="f-montserrat fs-5 ">MY VOLUNTEER INFO</div>
                            <div class="row my-3">
                                <div class="col-lg-6">
                                    <div class="px-4">
                                        <div class="f-montserrat mt-1">CHECKED IN TIME: <div class="f-lato">
                                                {{ $check_in }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="px-4">
                                        <div class="f-montserrat mt-1">CHECKED OUT TIME: <div class="f-lato">
                                                {{ $check_out }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" {{ $check_out == null ? 'd-none' : '' }}">
                                <div class="px-4">
                                    <div class="f-montserrat mt-1">PHOTO IN THE EVENT: </div>
                                    <div class="w-100"><img class="fixed-size-img"
                                            src="{{ asset('images/' . $proof_of_checkout) }}" alt="Uploaded photo"></div>
                                    <form method="POST" action="{{ route('join_as_volunteer.upload_photo') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                                        <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                        <div class="mt-3 {{ $proof_of_checkout != null ? 'd-none' : '' }}">
                                            <input type="file" name="photo" id="photo" class="form-control">
                                            <div class="text-center">
                                                <input type="submit" value="Upload"
                                                    class="view-event-btn f-montserrat mt-2">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
