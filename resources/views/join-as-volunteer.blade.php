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
                            SUCCESSFULLY JOINED AS A VOLUNTEER
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 p-4 my-auto">
                <div class="box-border-shadow-bt-red p-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class=" text-muted d-inline-block fs-10 ">{{ strtoupper($date) }} </div>
                            <div class=" text-success d-inline-block f-lato fs-10 mx-3"> STATUS:
                                {{ strtoupper($attendance_status) }}
                            </div>
                            <div class="f-montserrat fs-4 mb-4">JOINED AS VOLUNTEER</div>
                        </div>
                        <div class="col-lg-6 my-auto">
                            <div class="f-montserrat mb-auto fs-13 ">
                                ROLE: <em> {{ strtoupper($role == null ? 'no role assigned yet' : $role) }} </em>
                            </div>
                            <div class="f-montserrat mb-auto fs-13 pb-3">
                                STAFF: <em>
                                    {{ strtoupper($staff == null ? 'no staff assigned yet' : $staff->first_name . ' ' . $staff->last_name) }}
                                </em>
                            </div>
                        </div>
                    </div>
                    <div class="text-mute w-75 mx-auto">
                        <hr>
                    </div>
                    <div class="p-3">
                        <div class="my-3">
                            <div class="f-montserrat fs-5 ">MY VOLUNTEER INFO</div>
                            <div
                                class="text-warning fs-10 f-montserrat text-center my-3 {{ $today > $event->date ? 'd-none' : '' }}">
                                ON THE DAY OF THE EVENT, A
                                BUTTON WILL BE AVAILABLE FOR
                                YOU TO CHECK IN AND CHECK OUT.
                                EVENT
                            </div>


                            <div
                                class="bg-warning f-montserrat text-center border border-warning p-4 rounded text-white
                        @if ($check_out != null && $proof_of_checkout != null && $check_in != null && $attendance_status != 'validated') d-block
                        @else
                            d-none @endif">
                                PLEASE WAIT FOR THE STAFF TO VALIDATE YOUR VOLUNTEER ATTENDANCE.
                            </div>

                            <div class="mt-3 {{ $attendance_status != 'validated' ? 'd-none' : '' }}">
                                <div class="text-success f-montserrat text-center border border-success p-4 rounded">
                                    Your volunteer attendance has been validated by the staff
                                </div>
                            </div>
                            <div class="mt-3 {{ $check_in == null ? 'd-none' : '' }}">
                                <div class="f-montserrat mt-1 d-inline-block">CHECKED IN TIME:
                                </div>
                                <div class="d-inline-block">
                                    {{ date('F j, Y g:i A', strtotime($check_in)) }}
                                </div>
                            </div>
                            <div>
                                <div class="text-center">
                                    <form method="POST" action="{{ route('join_as_volunteer.check_in') }}">
                                        @csrf
                                        <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                                        <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                        <!-- Check-in button -->
                                        <button type="submit"
                                            class="view-event-btn f-montserrat {{ $check_in != null || $event->date != $today ? 'view-event-btn-disabled d-none' : '' }}"
                                            {{ $check_in != null || $event->date != $today ? 'disabled' : '' }}>
                                            Check In
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div
                                class="mt-3 {{ $check_in == null || $attendance_status == 'checked' || $attendance_status == 'validated' ? 'd-none' : '' }}">
                                <div
                                    class="bg-warning f-montserrat text-center border border-warning p-4 rounded text-white">
                                    <i class="fa-sharp fa-solid fa-triangle-exclamation"></i>
                                    Please go to your staff to check your Check In
                                </div>
                            </div>
                            <div class="mt-3 @if ($attendance_status == 'validated' || $attendance_status == 'checked') d-block @else d-none @endif">

                                <div class="f-montserrat ">PHOTO IN THE EVENT: </div>
                                <div class="m-2">
                                    Preview:
                                    <div class="text-center">
                                        <img id="preview" src="#" alt="Preview"
                                            style="display: none; max-width: 200px;">
                                    </div>
                                    <div class="w-100 {{ $proof_of_checkout == null ? 'd-none' : '' }}"><img
                                            class="fixed-size-img" src="{{ asset('images/' . $proof_of_checkout) }}"
                                            alt="Uploaded photo"></div>
                                    <form method="POST" action="{{ route('join_as_volunteer.upload_photo') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                                        <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                        <div class="mt-3 {{ $proof_of_checkout != null ? 'd-none' : '' }}">
                                            <input type="file" name="photo" id="photo" class="form-control"
                                                onchange="previewPhoto(event)" required>

                                            <div class="text-center mt-2">
                                                <input type="submit" value="Upload"
                                                    class="view-event-btn f-montserrat mt-2">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="mt-4 {{ $check_out == null ? 'd-none' : '' }}">
                                    <div class="f-montserrat mt-1 d-inline-block">CHECKED OUT TIME:
                                    </div>
                                    <div class="d-inline-block">
                                        {{ date('F j, Y g:i A', strtotime($check_out)) }}
                                    </div>
                                </div>

                                <div class="text-center">
                                    <div class="d-inline-block mt-1">
                                        <form method="POST" action="{{ route('join_as_volunteer.check_out') }}">
                                            @csrf
                                            <input type="hidden" name="volunteer_id"
                                                value="{{ Auth::user()->volunteer_id }}">
                                            <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                            <!-- Cancel registration button -->
                                            <button type="submit"
                                                class="view-event-btn f-montserrat {{ $event->date != $today || $proof_of_checkout == null || $check_out != null ? 'view-event-btn-disabled d-none' : '' }}"
                                                {{ $event->date != $today || $proof_of_checkout == null || $check_out != null ? 'disabled' : '' }}>
                                                Check Out
                                            </button>
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

    <script>
        function previewPhoto(event) {
            var input = event.target;
            var preview = document.getElementById('preview');
            preview.style.display = input.files && input.files[0] ? 'block' : 'none';

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
