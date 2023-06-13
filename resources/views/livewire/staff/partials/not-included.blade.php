@extends('layouts.app')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/table-style.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5 overflow-hidden">
        <div class="shadow p-3 mb-5 bg-white rounded">
            <div class="d-flex justify-content-center align-items-center">
                <div class="display-5 f-montserrat">
                    STAFF IS NOT PART OF THIS EVENT
                </div>
            </div>
        </div>
    </div>
@endsection
