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
                                    <div class="f-montserrat mb-2">{{ Auth::user()->r_credits }}</div>
                                    <div class="f-lato text-muted">First Name</div>
                                    <input class="form-control mb-2" type="text" name="first_name" id="first_name"
                                        value="{{ Auth::user()->first_name }}">
                                    <div class="f-lato text-muted">Last Name</div>
                                    <input class="form-control mb-2" type="text" name="last_name" id="last_name"
                                        value="{{ Auth::user()->last_name }}">
                                    <div class="f-lato text-muted ">Birthdate</div>
                                    <input class="form-control mb-2" type="text" id="datepicker" name="selected_date"
                                        value="{{ Auth::user()->birthdate }}">
                                    <div class="f-lato text-muted">Contact Number</div>
                                    <input class="form-control mb-2" type="text" name="contact_number"
                                        id="contact_number" value="{{ Auth::user()->contact_number }}">
                                    <div class="f-lato text-muted">Email Address</div>
                                    <div class="f-montserrat">{{ Auth::user()->email }}</div>
                                    <button type="submit"
                                        class="button f-montserrat text-center w-50 mx-auto mb-1 w-100 mt-4">UPDATE
                                        PROFILE
                                    </button>

                                    <button type="button" onclick="window.location='{{ route('profile.show') }}'"
                                        class="button f-montserrat text-center w-50 mx-auto mb-3 w-100"> CANCEL
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
