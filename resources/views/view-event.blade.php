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
            @if (session('error'))
                <div class="alert alert-danger p-2 mt-2">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success p-2 mt-2">
                    {{ session('success') }}
                </div>
            @endif
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

                <div class="box-border-shadow p-3 two-color-in-div">
                    <div class="d-flex justify-content-between f-montserrat">
                        <div class="text-muted">BE A VOLUNTEER</div>
                        <div class="fs-13">{{ strtoupper($event_start_date) . ' - ' . strtoupper($event_end_date) }}</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="f-montserrat fs-4">JOIN AS VOLUNTEER</div>
                        <div class="f-lato mb-auto text-muted text-end fs-10 w-25">START AND END DATE OF REGISTRATION</div>
                    </div>

                    <div
                        class=" mt-3 d-flex justify-content-between {{ $attendance_status == 'joining' ? 'd-none' : '' }}">
                        <!-- Display the status of the event -->
                        <div
                            class="text-success f-lato mb-auto fs-13 {{ $event_status == 'NOT AVAILABLE' || $event_status == 'VOLUNTEER CANCELLED' ? ' text-danger' : '' }}">
                            STATUS: {{ $event_status }}
                        </div>

                        <form id="joinForm" method="POST" action="{{ route('volunteer_status.store') }}">
                            @csrf
                            <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                            <input type="hidden" name="volunteer_fullname"
                                value="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}">
                            <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                            <button type="button" id="joinButton"
                                class="my-auto view-event-btn f-montserrat small {{ $event_status == 'NOT AVAILABLE' || $event_status == 'VOLUNTEER CANCELLED' ? 'view-event-btn-disabled' : '' }}"
                                {{ $event_status == 'NOT AVAILABLE' || $event_status == 'VOLUNTEER CANCELLED' ? 'disabled' : '' }}>
                                Join Now
                            </button>
                        </form>
                    </div>

                    <!-- Confirmation modal -->
                    <div id="confirmationModal" class="modal fade f-lato" tabindex="-1" role="dialog">
                        <div class="modal-dialog box-border-shadow" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">Are you sure you want to join?</h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="confirmNoButton" class="view-event-btn">No</button>
                                    <button type="button" id="confirmJoinButton" class="view-event-btn">Yes</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class=" {{ $attendance_status != 'joining' ? 'd-none' : '' }}">
                        <!-- Registration confirmation status -->
                        <div class="justify-content-between mt-2">
                            <div
                                class="text-success f-lato my-auto fs-13 mb-3{{ $event_status == 'NOT AVAILABLE' ? 'text-danger' : '' }}">
                                STATUS: {{ strtoupper($attendance_status) }}
                            </div>
                            <!-- Confirm registration button -->
                            <form method="POST" action="{{ route('volunteer_status.confirmed') }}">
                                @csrf
                                <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                                <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                <!-- Cancel registration button -->
                                <button class="my-auto view-event-btn f-montserrat small ">
                                    Confirm Registration
                                </button>
                            </form>
                        </div>

                        <!-- Confirmation modal -->
                        <div id="confirmationModal" class="modal fade f-lato" tabindex="-1" role="dialog">
                            <div class="modal-dialog box-border-shadow" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Confirm Join</h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <button type="button" id="confirmJoinButton" class="btn btn-primary">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cancellation modal -->
                        <div id="cancellationModal" class="modal fade f-lato" tabindex="-1" role="dialog">
                            <div class="modal-dialog box-border-shadow" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Are you sure you want to cancel? You will not be able to
                                            join again, and you will not be able to claim a code for this event.</h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="confirmNoBtn" class="view-event-btn">No</button>
                                        <button type="button" id="confirmYesBtn" class="view-event-btn">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="justify-content-between pt-1">

                            <form id="cancelForm" method="POST" action="{{ route('volunteer_status.cancelled') }}">
                                @csrf
                                <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                                <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                <!-- Cancel registration button -->
                                <button type="button" id="ConfirmCancel"
                                    class="my-auto view-event-btn f-montserrat small {{ $event_status == 'NOT AVAILABLE' ? 'view-event-btn-disabled' : '' }}"
                                    {{ $event_status == 'NOT AVAILABLE' ? 'disabled' : '' }} onclick="confirmCancel()">
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
                        <div class="fs-13">{{ strtoupper($code_start_date) . ' - ' . strtoupper($code_end_date) }}</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="f-montserrat fs-4">CLAIM CODE</div>
                        <div class="f-lato mb-auto text-muted text-end fs-10 w-25">START AND END DATE OF CLAIMING CODE
                        </div>
                    </div>
                    <div class="mt-3 d-flex justify-content-between ">
                        <div
                            class="text-success f-lato mb-auto fs-13 {{ $code_status == 'NOT AVAILABLE' ? 'text-danger' : '' }}">
                            STATUS: {{ $code_status }}
                        </div>
                        <button
                            class="my-auto view-event-btn f-montserrat small {{ $code_status == 'NOT AVAILABLE' || $attendance_status == 'joining' ? 'view-event-btn-disabled' : '' }}"
                            {{ $code_status == 'NOT AVAILABLE' ? 'disabled' : '' }} data-bs-toggle="collapse"
                            data-bs-target="#view" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="{{ __('Toggle navigation') }}">Claim Now</button>

                    </div>
                    <div class="mt-4 collapse bg-white p-4" id="view">
                        <div class="f-montserrat fs-5 mb-3">STEPS TO CLAIM CODE</div>
                        <form method="POST" action="{{ route('claim_code.store_race') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="p-3">
                                <div class="f-montserrat">
                                    1. SELECT AVAILABLE RACES
                                </div>
                                <div class="p-3">
                                    <div class="mb-4 ">
                                        <div class="block ">
                                            Reminder:
                                        </div>
                                        <div class="block">
                                            * The equivalent of 1 Free Race Credit is P3,500.
                                        </div>
                                        <div class="block">
                                            * If you select a race with an amount exceeding P3,500, you will be required to
                                            pay
                                            the
                                            remaining balance.
                                        </div>
                                    </div>

                                    <div class="">
                                        <i class="fa-solid fa-question fs-10 text-warning"></i>
                                        <div class="custom-tooltip d-inline-block f-lato fs-10 text-warning"
                                            data-toggle="tooltip" data-placement="top" data-trigger="click"
                                            title="Race credits are credits earned by a volunteer after volunteering at an event. In each event, the volunteer can earn one race credit. One race credit is valid only for one year, based on the date of the event where the volunteer earned the race credit. One race credit can be used by the volunteer to claim a free race code to an event.">
                                            WHAT IS RACE CREDITS
                                        </div>
                                    </div>
                                    <div class="d-block">
                                        <div class="f-lato text-muted fs-10 d-inline-block">YOUR RACE CREDITS:</div>
                                        <div class="f-lato text-muted fs-10 d-inline-block">{{ $race_credit_quantity }}
                                        </div>
                                    </div>
                                    <div
                                        class="f-lato text-muted fs-10 mb-2 text-warning {{ $race_credit_quantity != 0 ? 'd-none' : '' }}">
                                        <div class="text-danger">YOU DON'T HAVE ENOUGH RACE CREDITS</div>
                                    </div>


                                    <div class="f-lato mt-1">


                                        @foreach ($races as $race)
                                            <div>
                                                <input type="radio" name="race_id" value="{{ $race->race_id }}"
                                                    id="{{ $race->race_id }}" class="race-radio"
                                                    onclick="displayPrice('{{ $race->race_id }}', '{{ $race->price }}')"
                                                    required>
                                                <label
                                                    for="{{ $race->race_id }}">{{ strtoupper($race->race_type) }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="f-montserrat mt-5 w-100">
                                    2. SELECT UNCLAIMED RACE CREDIT
                                </div>
                                <div class="p-3">
                                    <select class="form-select w-100" id="raceCreditDropdown" name="credit_id" required>
                                        <option value="" selected disabled>Select Race Credit</option>
                                        @foreach ($race_credits as $race_credit)
                                            <option value="{{ $race_credit->credit_id }}">
                                                Race Credit: {{ $race_credit->title }},
                                                Expiration Date: {{ date('M j, Y', strtotime($race_credit->exp_date)) }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="f-montserrat mt-5 w-100">
                                    3. PAY BALANCE
                                </div>
                                <div class="p-2">
                                    <div id="priceDisplay" style="display: none;">
                                        <div class="d-block f-montserrat">
                                            Selected Race Price: <span id="racePrice"></span>
                                        </div>
                                        <div class="d-block f-montserrat">
                                            Race Credit Value: <span>{{ $r_credit_value }}</span>
                                        </div>
                                        <div class="d-block f-montserrat">
                                            You need to pay:
                                            <div class=" text-danger d-inline-block">
                                                <span id="raceBalance"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="receiptDisplay" style="display: none;">
                                        <div class="d-block mt-4">
                                            <div class="d-block">
                                                Please send your payment using any of the following modes of payment
                                                listed below.
                                            </div>
                                            <div class="d-block">
                                                Then, save a photo of your proof of payment and upload it in the space
                                                provided below. Thank you!
                                            </div>
                                        </div>

                                        <div class="d-block mt-4">
                                            <div class="d-block f-montserrat">
                                                Bank: BPI
                                            </div>
                                            <div class="d-block">
                                                Account Number: 5555-5555-55
                                            </div>
                                            <div class="d-block">
                                                Account Name: Juan Dela Cruz
                                            </div>
                                        </div>

                                        <div class="d-block mt-4">
                                            <div class="d-block f-montserrat">
                                                E-wallet: GCash
                                            </div>
                                            <div class="d-block">
                                                Account Number: 09123456789
                                            </div>
                                            <div class="d-block">
                                                Account Name: Juan Dela Cruz
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            Preview:
                                        </div>
                                        <div class="text-center mt-2">
                                            <img id="preview" src="#" alt="Preview"
                                                style="display: none; max-width: 100%;">
                                        </div>

                                        <input type="file" name="photo" id="photo" class="form-control"
                                            onchange="previewPhoto(event)">
                                    </div>
                                </div>
                                <div>
                                    <input type="hidden" name="volunteer_id" value="{{ Auth::user()->volunteer_id }}">
                                    <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                    <div class="f-montserrat mt-4 small">
                                        <button type="submit" {{ $race_credit_quantity == 0 ? 'disabled' : '' }}
                                            class="view-event-btn {{ $race_credit_quantity == 0 ? 'view-event-btn-disabled' : '' }}">
                                            Claim
                                            Race</button>
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
    <script>
        // Function to handle the confirmation modal for join
        function confirmJoin() {
            $('#confirmationModal').modal('show');
        }

        // Function to handle the "Yes" button click for join
        function confirmJoinYes() {
            $('#confirmationModal').modal('hide');
            document.getElementById('joinForm').submit(); // Submit the form
        }

        // Function to handle the "No" button click for join
        function confirmJoinNo() {
            $('#confirmationModal').modal('hide');
        }

        // Add event listener to the Join Now button
        document.getElementById('joinButton').addEventListener('click', confirmJoin);

        // Add event listener to the "Yes" button in the confirmation modal for join
        document.getElementById('confirmJoinButton').addEventListener('click', confirmJoinYes);

        // Add event listener to the "No" button in the confirmation modal for join
        document.getElementById('confirmNoButton').addEventListener('click', confirmJoinNo);

        // Function to handle the confirmation modal for cancel
        function confirmCancel() {
            $('#cancellationModal').modal('show');
        }

        // Function to handle the "Yes" button click for cancel
        function confirmYes() {
            document.getElementById('cancelForm').submit();
        }

        // Function to handle the "Yes" button click for cancel
        function confirmNo() {
            $('#cancellationModal').modal('hide');

        }

        // Add event listener to the "Yes" button in the confirmation modal for cancel
        document.getElementById('confirmYesBtn').addEventListener('click', confirmYes);

        // Add event listener to the "No" button in the confirmation modal for cancel
        document.getElementById('confirmNoBtn').addEventListener('click', confirmNo);

        // JavaScript/jQuery
        $(document).ready(function() {
            $('input[name="race_type"]').on('change', function() {
                var selectedRaceType = $(this).val();
                $('[id^="dropdownDiv_"]').hide(); // Hide all dropdown divs
                $('#dropdownDiv_' + selectedRaceType)
                    .show(); // Show the specific dropdown div for the selected race type
            });

        });

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

        };

        function displayPrice(raceId, price) {
            var priceDisplay = document.getElementById('priceDisplay');
            var racePrice = document.getElementById('racePrice');
            var raceBalance = document.getElementById('raceBalance');
            var receiptDisplay = document.getElementById('receiptDisplay');
            var photoInput = document.getElementById('photo');

            if (price !== null) {
                racePrice.textContent = price;
                raceBalance.textContent = price - 3500;
                priceDisplay.style.display = 'block';
                if (raceBalance.textContent != 0) {
                    receiptDisplay.style.display = 'block';
                    photoInput.required = true;
                    resetFileInput();
                    previewPhoto(event); // Call previewPhoto function after resetting the file input
                } else {
                    receiptDisplay.style.display = 'none';
                    photoInput.required = false;
                    previewPhoto(event); // Call previewPhoto function to hide the preview
                }
            } else {
                priceDisplay.style.display = 'none';
                receiptDisplay.style.display = 'none';
                photoInput.required = false;
                previewPhoto(event); // Call previewPhoto function to hide the preview
            }
        }

        function resetFileInput() {
            var fileInput = document.getElementById('photo');
            fileInput.value = '';
        }


        $(document).ready(function() {
            // Enable Bootstrap tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Handle click event to show tooltip on mobile devices
            if (/Mobi|Android/i.test(navigator.userAgent)) {
                $('[data-toggle="tooltip"]').on('click', function() {
                    $(this).tooltip('show');
                });
            }
        });
    </script>
@endsection
