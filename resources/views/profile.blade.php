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

                @if (session('success'))
                    <div class="alert alert-success p-2 mt-2">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="box-border-shadow-bt-red mb-5">
                    <div class="f-montserrat h4 m-4">VOLUNTEER INFO</div>
                    <div class="mx-5">
                        <div class="row">
                            <div class="col-lg-6 my-auto">
                                <div class="text-center">
                                    @if (Auth::user()->profile_picture == null)
                                        <img class="w-75" src="{{ asset('/images/spartan-logo-favicon.png') }}">
                                    @else
                                        <img width="200" height="200" class="mb-5 rounded-circle"
                                            src="{{ asset('images/' . Auth::user()->profile_picture) }}" alt="">
                                    @endif
                                </div>

                                <i class="fa-solid fa-id-card d-inline-block"></i>
                                <div class="f-lato text-muted d-inline-block">Volunteer Id</div>
                                <div class="f-montserrat mb-2"> <b> {{ Auth::user()->volunteer_id }} </b> </div>
                            </div>
                            <div class="col-lg-6 mb-5">
                                <div class="f-lato text-muted">Race Credits</div>
                                <div class="f-montserrat mb-2"> {{ Auth::user()->r_credits }} </div>
                                <div class="f-lato text-muted">First Name</div>
                                <div class="f-montserrat mb-2"> {{ Auth::user()->first_name }} </div>
                                <div class="f-lato text-muted">Last Name</div>
                                <div class="f-montserrat  mb-2"> {{ Auth::user()->last_name }} </div>
                                <div class="f-lato text-muted ">Birthdate</div>
                                <div class="f-montserrat mb-2  {{ Auth::user()->birthdate == null ? 'text-warning' : '' }}">
                                    {{ Auth::user()->birthdate == null ? 'No birthdate assigned yet' : Auth::user()->birthdate }}
                                </div>
                                <div class="f-lato text-muted">Contact Number</div>
                                <div
                                    class="f-montserrat mb-2 {{ Auth::user()->contact_number == null ? 'text-warning' : '' }}">
                                    {{ Auth::user()->contact_number == null ? 'No contact number assigned yet' : Auth::user()->contact_number }}
                                </div>

                                <div class="f-lato text-muted">Email Address</div>
                                <div class="f-montserrat" id="email">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>
                            <button class="button f-montserrat text-center w-50 mx-auto mb-3"
                                onclick="window.location='{{ route('volunteer_info_edit') }}'">EDIT INFO</button>
                        </div>
                    </div>
                </div>

                <div class="box-border-shadow-bt-red mb-5">
                    <div class="f-montserrat h4 m-4">ADDRESS</div>
                    <div class="mx-5">
                        <div class="f-lato text-muted">Street Address</div>
                        <div class="f-montserrat mb-2  {{ Auth::user()->street_add == null ? 'text-warning' : '' }}">
                            {{ Auth::user()->street_add == null ? 'No street addres assigned yet' : Auth::user()->street_add }}
                        </div>
                        <div class="f-lato text-muted">Country</div>
                        <div class="f-montserrat mb-2  {{ Auth::user()->country == null ? 'text-warning' : '' }}">
                            {{ Auth::user()->country == null ? 'No Country assigned yet' : Auth::user()->country }}
                        </div>
                        <div class="f-lato text-muted ">City</div>
                        <div class="f-montserrat mb-2  {{ Auth::user()->city == null ? 'text-warning' : '' }}">
                            {{ Auth::user()->city == null ? 'No City assigned yet' : Auth::user()->city }}
                        </div>
                        <div class="f-lato text-muted">Zip Code</div>
                        <div class="f-montserrat mb-2 {{ Auth::user()->zip == null ? 'text-warning' : '' }}">
                            {{ Auth::user()->zip == null ? 'No Zip Code assigned yet' : Auth::user()->zip}}
                        </div>

                        <div class="f-lato text-muted">Complete Secondary Address</div>
                        <div class="f-montserrat mb-2  {{ Auth::user()->second_add == null ? 'text-warning' : '' }}">
                            {{ Auth::user()->second_add == null ? 'No second address assigned yet' : Auth::user()->second_add}}
                        </div>
                        <div class="text-center">
                            <button class="button f-montserrat w-50 mt-5 mb-3"
                                onclick="window.location='{{ route('address_edit') }}'">EDIT ADDRESS</button>
                        </div>
                    </div>
                </div>

                <div class="box-border-shadow-bt-red mb-5">
                    <div class="f-montserrat h4 m-4">EMERGENCY CONTACT</div>
                    <div class="mx-5">
                        <div class="f-lato text-muted">Race Credits</div>
                        <div class="f-montserrat mb-2"> {{ Auth::user()->r_credits }} </div>
                        <div class="f-lato text-muted">First Name</div>
                        <div class="f-montserrat mb-2"> {{ Auth::user()->first_name }} </div>
                        <div class="f-lato text-muted">Last Name</div>
                        <div class="f-montserrat  mb-2"> {{ Auth::user()->last_name }} </div>
                        <div class="f-lato text-muted ">Birthdate</div>
                        <div class="f-montserrat mb-2  {{ Auth::user()->birthdate == null ? 'text-warning' : '' }}">
                            {{ Auth::user()->birthdate == null ? 'No birthdate assigned yet' : Auth::user()->birthdate }}
                        </div>
                        <div class="f-lato text-muted">Contact Number</div>
                        <div class="f-montserrat mb-2 {{ Auth::user()->contact_number == null ? 'text-warning' : '' }}">
                            {{ Auth::user()->contact_number == null ? 'No contact number assigned yet' : Auth::user()->contact_number }}
                        </div>

                        <div class="f-lato text-muted">Email Address</div>
                        <div class="f-montserrat" id="email">
                            {{ Auth::user()->email }}
                        </div>
                        <div class="text-center">
                            <button class="button f-montserrat w-50 mt-5 mb-3"
                                onclick="window.location='{{ route('volunteer_info_edit') }}'">EDIT CONTACT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2"></div>
@endsection
