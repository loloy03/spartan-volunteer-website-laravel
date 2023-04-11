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
                <div class="mx-5">
                    <div class="f-montserrat display-5 my-5">SETTINGS</div>
                    <div class="box-border-shadow-bt-red mb-5">
                        <div class="f-montserrat h4 m-4">PROFILE</div>
                        <div class="mx-5">
                            <div class="row">
                                <div class="col-lg-6 my-auto">
                                    <div class="text-center">
                                        <img class="w-75" src="{{ asset('/images/spartan-logo-favicon.png') }}"
                                            alt="">
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
                                    <div
                                        class="f-montserrat mb-2  {{ Auth::user()->birthdate == null ? 'text-warning' : '' }}">
                                        {{ Auth::user()->birthdate == null ? 'No birthdate assigned yet' : Auth::user()->birthdate }}
                                    </div>
                                    <div class="f-lato text-muted">Contact Number</div>
                                    <div
                                        class="f-montserrat mb-2 {{ Auth::user()->contact_number == null ? 'text-warning' : '' }}">
                                        {{ Auth::user()->contact_number == null ? 'No contact number assigned yet' : Auth::user()->birthdate }}
                                    </div>

                                    <div class="f-lato text-muted">Email Address</div>
                                    <div class="f-montserrat">
                                        {{ Auth::user()->email }} </>
                                    </div>
                                </div>
                                <button class="button f-montserrat text-center w-50 mx-auto mb-3">EDIT PROFILE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
@endsection
