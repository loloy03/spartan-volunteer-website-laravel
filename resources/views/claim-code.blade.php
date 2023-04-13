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
                </div>
            </div>
            <div class="col-lg-6 p-4 my-auto">
                <div class="box-border-shadow-bt-red p-3">
                    <div class="f-montserrat">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class=" text-muted d-inline-block fs-10 ">{{ strtoupper($date) }} </div>
                                <div class="fs-4 mb-3">CLAIM CODE</div>
                            </div>
                            <div class="col-lg-6 my-auto">
                                <div class="d-block">
                                    <div class=" f-lato d-inline-block">KIND OF RACE TO BE CLAIM:</div>
                                    <div class="d-inline-block text-danger"> {{ strtoupper($race_type) }} </div>
                                </div>
                                <div class=" f-lato d-inline-block ">STATUS: </div>
                                <div class="text-success d-inline-block {{ $status == 'pending' ? 'text-warning' : '' }}">
                                    {{ strtoupper($status) }}
                                </div>
                            </div>
                        </div>

                        {{-- if the user need to pay --}}
                        <div class="f-montserrat text-muted mt-4 {{ $status != 'unpaid' ? 'd-none' : '' }} ">
                            <div class="d-inline-block">REMARKS:</div>
                            {{ $remarks }}

                            <div class="f-lato fs-10 mt-4">PLEASE SEND YOUR RECEIPT HERE:</div>
                            @if (session('success'))
                                <div class="alert alert-success p-2 mt-2">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('claim_code.upload_receipt') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                                <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                <input type="file" name="photo" id="photo" class="form-control">
                                <div class="text-center">
                                    <input type="submit" value="Upload" class="view-event-btn f-montserrat mt-2">
                                </div>
                            </form>
                        </div>

                        {{-- display if the status is available  --}}
                        <div class="f-montserrat text-muted mt-4 {{ $status != 'available' ? 'd-none' : '' }} ">
                            PLEASE WAIT FOR YOUR CODE
                        </div>

                        {{-- if the race code is available --}}
                        <div class=" {{ $race_code == null ? 'd-none' : '' }}">
                            <div class="f-lato text-muted mt-4 fs-10 mb-2">YOUR CODE IS:</div>
                            <div class="f-montserrat display-5 border border-danger rounded text-center p-1">
                                {{ $race_code }} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
