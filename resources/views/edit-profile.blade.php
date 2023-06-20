@extends('layouts.app')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/profile.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="f-druk-wide display-5 my-5">PROFILE</div>
                <div class="box-border-shadow-bt-red mb-5">
                    <div class="f-montserrat h4 m-4">VOLUNTEER INFO</div>
                    <div class="mx-5">

                        <form action="{{ route('volunteer_info.update') }}" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-6 my-auto">
                                    <div class="text-center mb-auto">
                                        @if (Auth::user()->profile_picture == null)
                                            <img class="w-75" src="{{ asset('/images/spartan-logo-favicon.png') }}">
                                        @else
                                            <img width="200" height="200" class="mb-5 rounded-circle"
                                                src="{{ asset('images/' . Auth::user()->profile_picture) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="f-lato text-muted">Upload Profile Picture</div>
                                    <input type="file" name="photo" id="photo" class="form-control mb-4"
                                        value="{{ Auth::user()->profile_picture }}">
                                    <i class="fa-solid fa-id-card d-inline-block"></i>
                                    <div class="f-lato text-muted d-inline-block">Volunteer Id</div>
                                    <div class="f-montserrat mb-2"> <b> {{ Auth::user()->volunteer_id }} </b> </div>
                                </div>
                                <div class="col-lg-6 mb-5">
                                    @csrf
                                    <div class="f-lato text-muted">Race Credits</div>
                                    <div class="f-montserrat mb-2"> {{ $race_credit_quantity }} </div>
                                    <div class="f-lato text-muted">First Name</div>
                                    <input class="form-control mb-2" type="text" name="first_name" id="first_name"
                                        value="{{ Auth::user()->first_name }}" pattern="[A-Za-z ]+"
                                        title="Please enter a valid first name" required>
                                    <div class="f-lato text-muted">Last Name</div>
                                    <input class="form-control mb-2" type="text" name="last_name" id="last_name"
                                        value="{{ Auth::user()->last_name }}" pattern="[A-Za-z ]+"
                                        title="Please enter a valid last name" required>

                                    <div class="f-lato text-muted">Occupation</div>
                                    <select class="form-control mb-2" name="occupation" id="occupation" required>
                                        <option value="">Select Occupation</option>
                                        <option value="Engineer" @if (Auth::user()->occupation == 'Engineer') selected @endif>Engineer
                                        </option>
                                        <option value="Teacher" @if (Auth::user()->occupation == 'Teacher') selected @endif>Teacher
                                        </option>
                                        <option value="Doctor" @if (Auth::user()->occupation == 'Doctor') selected @endif>Doctor
                                        </option>
                                        <option value="Lawyer" @if (Auth::user()->occupation == 'Lawyer') selected @endif>Lawyer
                                        </option>
                                        <option value="Architect" @if (Auth::user()->occupation == 'Architect') selected @endif>
                                            Architect</option>
                                        <option value="Accountant" @if (Auth::user()->occupation == 'Accountant') selected @endif>
                                            Accountant</option>
                                        <option value="Designer" @if (Auth::user()->occupation == 'Designer') selected @endif>Designer
                                        </option>
                                        <option value="Writer" @if (Auth::user()->occupation == 'Writer') selected @endif>Writer
                                        </option>
                                        <option value="Nurse" @if (Auth::user()->occupation == 'Nurse') selected @endif>Nurse
                                        </option>
                                        <option value="Artist" @if (Auth::user()->occupation == 'Artist') selected @endif>Artist
                                        </option>
                                        <option value="Chef" @if (Auth::user()->occupation == 'Chef') selected @endif>Chef
                                        </option>
                                        <option value="Developer" @if (Auth::user()->occupation == 'Developer') selected @endif>
                                            Developer</option>
                                        <option value="Photographer" @if (Auth::user()->occupation == 'Photographer') selected @endif>
                                            Photographer</option>
                                        <option value="Marketing Specialist"
                                            @if (Auth::user()->occupation == 'Marketing Specialist') selected @endif>Marketing Specialist
                                        </option>
                                        <option value="Student" @if (Auth::user()->occupation == 'Student') selected @endif>Student
                                        </option>
                                        <option value="Retail Sales Associate"
                                            @if (Auth::user()->occupation == 'Retail Sales Associate') selected @endif>Retail Sales Associate
                                        </option>
                                        <option value="Customer Service Representative"
                                            @if (Auth::user()->occupation == 'Customer Service Representative') selected @endif>Customer Service
                                            Representative</option>
                                        <option value="Delivery Driver" @if (Auth::user()->occupation == 'Delivery Driver') selected @endif>
                                            Delivery Driver</option>
                                        <option value="Barista" @if (Auth::user()->occupation == 'Barista') selected @endif>Barista
                                        </option>
                                        <option value="Unemployed" @if (Auth::user()->occupation == 'Unemployed') selected @endif>
                                            Unemployed
                                        </option>
                                        <option value="Others" @if (Auth::user()->occupation == 'Unemployed') selected @endif>
                                            Others
                                        </option>
                                        <!-- Add more options as needed -->
                                    </select>

                                    <div class="f-lato text-muted ">Birthdate</div>
                                    <input class="form-control mb-2" type="text" id="datepicker" name="selected_date"
                                        value="{{ Auth::user()->birthdate }}">
                                    <div class="f-lato text-muted">Contact Number</div>
                                    <input class="form-control mb-2" type="text" name="contact_number"
                                        id="contact_number" pattern="\639\d{9}"
                                        title="Please enter a contact number in the format 639XXXXXXXXX"
                                        placeholder="+639XXXXXXXXX" value="{{ Auth::user()->contact_number }}" required>
                                    <div class="f-lato text-muted">Email Address</div>
                                    <div class="f-montserrat">{{ Auth::user()->email }}</div>
                                    <button type="submit"
                                        class="button f-montserrat text-center w-50 mx-auto mb-1 w-100 mt-4 small">UPDATE
                                        PROFILE
                                    </button>

                                    <button type="button" onclick="window.location='{{ route('profile.show') }}'"
                                        class="button f-montserrat text-center w-100 mx-auto mb-3 w-100 small"> CANCEL
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2"></div>
    {{-- script for date picker --}}
    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>
@endsection
