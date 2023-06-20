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

                <form action="{{ route('address_update') }}" method="post" enctype="multipart/form-data">

                    @csrf

                    <div class="box-border-shadow-bt-red mb-5">
                        <div class="f-montserrat h4 m-4">ADDRESS</div>
                        <div class="mx-5">
                            <div class="f-lato text-muted">Street Address</div>
                            <input class="form-control mb-2" type="text" name="street_add" id="street_add"
                                value="{{ Auth::user()->street_add }}">
                            <div class="f-lato text-muted ">Province</div>
                            <input class="form-control mb-2" type="text" name="province" id="province"
                                value="{{ Auth::user()->province }}">

                            <div class="f-lato text-muted ">City</div>
                            <input class="form-control mb-2" type="text" name="city" id="city"
                                value="{{ Auth::user()->city }}">
                            <div class="f-lato text-muted">Country</div>
                            <div class="f-montserrat mb-2"> {{ Auth::user()->country }} </div>
                            <div class="f-lato text-muted">Zip Code</div>
                            <input class="form-control mb-2" type="text" name="zip" id="zip"
                                value="{{ Auth::user()->zip }}">
                            <div class="text-center">
                                <button type="submit" class="button f-montserrat text-center w-100 mt-4 small">UPDATE
                                    ADDRESS
                                </button>
                                <button type="button" class="button f-montserrat w-100 mt-2 mb-3 small"
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
    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>
@endsection
