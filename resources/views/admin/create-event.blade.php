@extends('layouts.auth-navbar')

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
    <div class="container">
        <div class="container-fluid p-4">
            <form action="/create-event" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <!--
                        PAGE 1
                        CREATE EVENT FORM
                    -->
                    @include('admin.partials.event-form')
                    <!--
                        PAGE 2
                        ADD ROLES FORM
                    -->
                    @include('admin.partials.role-form')
                </div>
            </form>
        </div>
    </div>
    <!-- HTML has to load first for js script to work -->
    <script src="{{ asset('js/image-preview.js') }}"></script>
    <script src="{{ asset('js/datepicker.js') }}"></script>
    <script src="{{ asset('js/persisting-data.js') }}"></script>
    <script src="{{ asset('js/add-category.js') }}"></script>
    <script src="{{ asset('js/add-staff.js') }}"></script>
@endsection