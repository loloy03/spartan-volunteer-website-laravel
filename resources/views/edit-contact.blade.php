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

                <form action="{{ route('contact_update') }}" method="post" enctype="multipart/form-data">

                    @csrf

                    <div class="box-border-shadow-bt-red mb-5">
                        <div class="f-montserrat h4 m-4">EMERGENCY CONTACT</div>
                        <div class="mx-5">
                            <div class="f-lato text-muted">Contact Person</div>
                            <input class="form-control mb-2" type="text" name="emergency_contact_name" id="emergency_contact_name"
                                value="{{ Auth::user()->emergency_contact_name }}">
                            <div class="f-lato text-muted">Contact Number</div>
                            <input class="form-control mb-2" type="text" name="emergency_number" id="emergency_number"
                                value="{{ Auth::user()->emergency_number }}">
                            <div class="text-center">
                                <button type="submit" class="button f-montserrat text-center w-50  mt-4">UPDATE
                                    CONTACT
                                </button>
                                <button type="button" class="button f-montserrat w-50 mt-2 mb-3"
                                    onclick="window.location='{{ route('profile.show') }}'">CANCEL</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="col-lg-2"></div>
    </div>
    </div>
    {{-- script for date picker --}}
@endsection
