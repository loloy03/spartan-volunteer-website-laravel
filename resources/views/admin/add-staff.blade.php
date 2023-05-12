{{-- @extends('layouts.auth-navbar')

@section('import-css')
    <!-- JQueryUI CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"
        integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/admin/create-event.css') }}">
    <!-- Some box icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
@endsection

@section('import-js')
    <!-- JQuery Scripts for Dates -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"
        integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('content')
    <!-- input should be inputted as list element -->

    <form action="/add-staff" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="container-fluid p-4">
                <div class="title-header mb-3 f-montserrat">
                    <h1>ROLE MANAGEMENT</h1>
                </div>
                <div class="col">
                    <div class="form-group row role-input mb-2">
                        <label class="col-form-label col-sm-3 role-label f-montserrat">REGISTRATION</label>
                        <div class="col-sm-2 add-staff">
                            <button type="button" class="btn btn-danger btn-modal staff-role" data-bs-toggle="modal"
                            data-bs-target="#staffs" data-role="registration">
                            + Staff
                        </button>
                        </div>
                        <div class="col-sm-6">
                            <div class="overflow-auto">
                                <ul class="list-group list-group-horizontal flex-nowrap" id="registration"
                                    data-group="registration">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row role-input mb-2">
                        <label class="col-form-label col-sm-3 role-label f-montserrat">START LINE</label>
                        <div class="col-sm-2 add-staff">
                            <button type="button" class="btn btn-danger btn-modal staff-role" data-bs-toggle="modal"
                            data-bs-target="#staffs" data-role="start-line">
                            + Staff
                        </button>
                        </div>
                        <div class="col-sm-6">
                            <div class="overflow-auto">
                                <ul class="list-group list-group-horizontal flex-nowrap" id="start-line"
                                    data-group="start-line">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row role-input mb-2">
                        <label class="col-form-label col-sm-3 role-label f-montserrat">FINISHER TENT</label>
                        <div class="col-sm-2 add-staff">
                            <button type="button" class="btn btn-danger btn-modal staff-role" data-bs-toggle="modal"
                            data-bs-target="#staffs" data-role="finisher-tent">
                            + Staff
                        </button>
                        </div>
                        <div class="col-sm-6">
                            <div class="overflow-auto">
                                <ul class="list-group list-group-horizontal flex-nowrap" id="finisher-tent"
                                    data-group="finisher-tent">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row role-input mb-2">
                        <label class="col-form-label col-sm-3 role-label f-montserrat">MERCHANDISE</label>
                        <div class="col-sm-2 add-staff">
                            <button type="button" class="btn btn-danger btn-modal staff-role" data-bs-toggle="modal"
                            data-bs-target="#staffs" data-role="merchandise">
                            + Staff
                        </button>
                        </div>
                        <div class="col-sm-6">
                            <div class="overflow-auto">
                                <ul class="list-group list-group-horizontal flex-nowrap" id="merchandise"
                                    data-group="merchandise">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row role-input mb-2">
                        <label class="col-form-label col-sm-3 role-label f-montserrat">SOCIAL DISTANCING</label>
                        <div class="col-sm-2 add-staff">
                            <button type="button" class="btn btn-danger btn-modal staff-role" data-bs-toggle="modal"
                            data-bs-target="#staffs" data-role="social-distancing">
                            + Staff
                        </button>
                        </div>
                        <div class="col-sm-6">
                            <div class="overflow-auto">
                                <ul class="list-group list-group-horizontal flex-nowrap" id="social-distancing"
                                    data-group="social-distancing">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row role-input mb-2">
                        <label class="col-form-label col-sm-3 role-label f-montserrat">BAG CHECK</label>
                        <div class="col-sm-2 add-staff">
                            <button type="button" class="btn btn-danger btn-modal staff-role" data-bs-toggle="modal"
                            data-bs-target="#staffs" data-role="bag-check">
                            + Staff
                        </button>
                        </div>
                        <div class="col-sm-6">
                            <div class="overflow-auto">
                                <ul class="list-group list-group-horizontal flex-nowrap" id="bag-check"
                                    data-group="bag-check">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row role-input mb-2">
                        <label class="col-form-label col-sm-3 role-label f-montserrat">CHANGING ROOMS</label>
                        <div class="col-sm-2 add-staff">
                            <button type="button" class="btn btn-danger btn-modal staff-role" data-bs-toggle="modal"
                            data-bs-target="#staffs" data-role="changing-rooms">
                            + Staff
                        </button>
                        </div>
                        <div class="col-sm-6">
                            <div class="overflow-auto">
                                <ul class="list-group list-group-horizontal flex-nowrap" id="changing-rooms"
                                    data-group="changing-room">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row role-input mb-2">
                        <label class="col-form-label col-sm-3 role-label f-montserrat">PORTA-POTIES</label>
                        <div class="col-sm-2 add-staff">
                            <button type="button" class="btn btn-danger btn-modal staff-role" data-bs-toggle="modal"
                            data-bs-target="#staffs" data-role="porta-potties">
                            + Staff
                        </button>
                        </div>
                        <div class="col-sm-6">
                            <div class="overflow-auto">
                                <ul class="list-group list-group-horizontal flex-nowrap" id="porta-potties"
                                    data-group="porta-potties">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row role-input mb-2">
                        <label class="col-form-label col-sm-3 role-label f-montserrat">VOLUNTEERS TENT</label>
                        <div class="col-sm-2 add-staff">
                            <button type="button" class="btn btn-danger btn-modal staff-role" data-bs-toggle="modal"
                            data-bs-target="#staffs" data-role="volunteers-tent">
                            + Staff
                        </button>
                        </div>
                        <div class="col-sm-6">
                            <div class="overflow-auto">
                                <ul class="list-group list-group-horizontal flex-nowrap" id="volunteers-tent"
                                    data-group="volunteer-tent">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row role-input mb-2">
                        <label class="col-form-label col-sm-3 role-label f-montserrat">AID STATION</label>
                        <div class="col-sm-2 add-staff">
                            <button type="button" class="btn btn-danger btn-modal staff-role" data-bs-toggle="modal"
                            data-bs-target="#staffs" data-role="aid-station">
                            + Staff
                        </button>
                        </div>
                        <div class="col-sm-6">
                            <div class="overflow-auto">
                                <ul class="list-group list-group-horizontal flex-nowrap" id="aid-station"
                                    data-group="aid-station">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row role-input mb-2">
                        <label class="col-form-label col-sm-3 role-label f-montserrat">GEAR CHECK</label>
                        <div class="col-sm-2 add-staff">
                            <button type="button" class="btn btn-danger btn-modal staff-role" data-bs-toggle="modal"
                            data-bs-target="#staffs" data-role="gear-check">
                            + Staff
                        </button>
                        </div>
                        <div class="col-sm-6">
                            <div class="overflow-auto">
                                <ul class="list-group list-group-horizontal flex-nowrap" id="gear-check"
                                    data-group="gear-check">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row role-input mb-2">
                        <label class="col-form-label col-sm-3 role-label f-montserrat">TRANSITION TENT</label>
                        <div class="col-sm-2 add-staff">
                            <button type="button" class="btn btn-danger btn-modal staff-role" data-bs-toggle="modal"
                            data-bs-target="#staffs" data-role="transition-tent">
                            + Staff
                        </button>
                        </div>
                        <div class="col-sm-6">
                            <div class="overflow-auto">
                                <ul class="list-group list-group-horizontal flex-nowrap" id="transition-tent"
                                    data-group="transition-tent">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.staff-modal');
        </div>
        <div class="form-group mt-3 event-form d-grid gap-2">
            <button type="submit" name="create-event" class="btn btn-danger">MANAGE ROLES</button>
            <button type="button" name="cancel" class="btn btn-dark">CANCEL</button>
        </div>
    </form>
    <script src="{{ asset('js/add-staff.js') }}"></script>
@endsection --}}
