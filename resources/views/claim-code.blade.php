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
                                    <div class="f-lato d-inline-block">KIND OF RACE TO BE CLAIM:</div>
                                    <div class="d-inline-block text-danger">{{ strtoupper($race_type) }}</div>
                                </div>
                                <div class="{{ $race_code->status == 'checking' ? 'd-none' : '' }}">
                                    <div class="f-lato d-inline-block">STATUS:</div>
                                    <div
                                        class="text-success d-inline-block {{ $race_code->status == 'pending' ? 'text-warning' : '' }}">
                                        {{ strtoupper($race_code->status) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- if the user need to pay --}}
                        <div
                            class="f-montserrat text-muted mt-4 {{ $race_price < 0 || $race_code->status != 'checking' ? 'd-none' : '' }} ">

                            <div class="mb-4">
                                <div class="block">
                                    Reminder:
                                </div>
                                <div class="block">
                                    * The equivalent of 1 Free Race Credit is P3,500.
                                </div>
                                <div class="block">
                                    * If you select a race with an amount exceeding P3,500, you will be required to pay the
                                    remaining balance.
                                </div>
                            </div>

                            <div class="d-block">
                                <div class="d-inline-block">Race Price: </div>
                                {{ $race_price }}
                            </div>
                            <div class="d-block">
                                <div class="d-inline-block">Race Credit Value: </div>
                                {{ $r_credit_value }}
                            </div>
                            <div class="d-block">
                                <div class="d-inline-block">You need to pay: </div>
                                {{ $race_price - $r_credit_value }}
                            </div>
                        </div>

                        <div
                            class="{{ $race_price - $r_credit_value == 0 || $race_code->status != 'checking' ? 'd-none' : '' }}">
                            <div class="f-lato fs-10 mt-4">PLEASE SEND YOUR RECEIPT HERE:</div>
                            @if (session('success'))
                                <div class="alert alert-success p-2 mt-2">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div>
                                Preview:
                            </div>
                            <div class="text-center mt-2">
                                <img id="preview" src="#" alt="Preview" style="display: none; max-width: 100%;">
                            </div>


                            <form method="POST" action="{{ route('claim_code.upload_receipt') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                                <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                <input type="file" name="photo" id="photo" class="form-control"
                                    onchange="previewPhoto(event)">
                                <div class="text-center">
                                    <input type="submit" value="Upload and Confirm Claim Code"
                                        class="view-event-btn f-montserrat mt-2">
                                </div>
                            </form>

                            <form method="POST" action="{{ route('claim_code.cancel') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                                <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                <div class="text-center">
                                    <input type="submit" value="Cancel" class="view-event-btn f-montserrat mt-2">
                                </div>
                            </form>
                        </div>

                        <div
                            class="{{ $race_price - $r_credit_value != 0 || $race_code->status != 'checking' ? 'd-none' : '' }}">
                            <form method="POST" action="{{ route('claim_code.confirm') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                                <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                <div class="text-center">
                                    <input type="submit" value="Confirm Claim Code"
                                        class="view-event-btn f-montserrat mt-2">
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- display if the status is pending  --}}
                    <div class="f-montserrat text-muted mt-4 {{ $race_code->status != 'pending' ? 'd-none' : '' }} ">
                        PLEASE WAIT FOR THE ADMIN TO VERIFY YOUR CLAIM RACE
                    </div>

                    {{-- display if the status is available  --}}
                    <div class="f-montserrat text-muted mt-4 {{ $race_code->status != 'claimed' ? 'd-none' : '' }} ">
                        PLEASE WAIT FOR YOUR CODE
                    </div>


                    {{-- if the race code is available --}}
                    <div class=" {{ $race_code->race_code == null || $race_code->status != 'released' ? 'd-none' : '' }}">
                        <div class="f-lato text-muted mt-4 fs-10 mb-2">YOUR CODE IS:</div>
                        <div class="f-montserrat display-5 border border-danger rounded text-center p-1">
                            {{ $race_code->race_code }} </div>
                        <div class="f-lato text-muted mt-4 mb-2">Code Expiration:
                            {{ $race_code->race_code_expiration }}</div>
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
