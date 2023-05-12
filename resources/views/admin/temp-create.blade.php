{{-- @extends('layouts.auth-navbar')

@section('import-css')
    <!-- JQueryUI CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/admin/create-event.css') }}">
    <!-- Some box icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
@endsection

@section('import-js')
    <!-- JQuery Scripts for Dates -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('content')
    <div class="container">
        <div class="container-fluid p-4">
            <form action="" method="POST" enctype="multipart/form-data">

                <div class="row">

                    <!--
                        left column
                    -->
                    <div class="col-md-6">
                        <div class="image-file">
                            <input type="file" class="form-control-file" name="input-image" id="file" accept="image/*" title="Please Upload an Image" hidden required>
                                <div class="image-area container-fluid">
                                    <i class="bx bx-upload icon"></i>
                                    <h3>Upload Event Image</h3>
                                    <h6>Minimum Resolution: 480x360</h6>
                                </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="event">Event</label>
                            <input type="text" class="form-control mt-2" name="event" id="event"
                                placeholder="Enter title...">
                        </div>
                        <div class="form-group mb-3">
                            <label for="desc">Description</label>
                            <textarea class="form-control mt-2" name="desc" id="desc" placeholder="Enter description..."></textarea>
                        </div>
                    </div>

                    <!--
                        right column
                    -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="loc">Location</label>
                            <input type="text" class="form-control mt-2" name="loc" id="loc"
                                placeholder="Enter location...">
                        </div>
                        <div class="form-group mb-3">
                            <label for="reg-start">Registration Start</label>
                            <input type="text" class="form-control mt-2 datepicker" name="reg-start" id="reg-start-datepicker">
                        </div>
                        <div class="form-group mb-3">
                            <label for="reg-end">Registration End</label>
                            <input type="text" class="form-control mt-2 datepicker" name="reg-end" id="reg-end-datepicker">
                        </div>
                        <div class="form-group mb-3">
                            <label for="reg-end">Event Start Date</label>
                            <input type="text" class="form-control mt-2 datepicker" name="event-date" id="event-date-datepicker">
                        </div>
                        <div class="form-group mb-3">
                            <label for="event-end">Event End Date</label>
                            <input type="text" class="form-control mt-2 datepicker" name="event-end" id="event-end-datepicker">
                        </div>
                        <div class="form-group mt-3 d-grid gap-2">
                            <button type="submit" name="create-event" class="btn btn-primary">Staff Roles</button>
                            <button type="submit" name="cancel" class="btn btn-primary">Cancel</button>
                          </div>                                                 
                    </div>

                </div>

            </form>
        </div>
    </div>
    <!-- HTML has to load first for js script to work -->
    <script src="{{ asset('js/image-preview.js') }}"></script>
    <script src="{{ asset('js/datepicker.js') }}"></script>
@endsection --}}
