@extends('layouts.auth-navbar')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/table-style.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5 overflow-hidden">
        <div class="row justify-content-center text-center mb-4">
            <div class="col-sm-2">
                <button class="btn">
                    EXPORT LIST
                </button>
            </div>
            <div class="col-sm-2">
                <button class="btn">
                    DISTRIBUTE CODE
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col">PICTURE PROOF</th>
                        <th class="col">FIRST NAME</th>
                        <th class="col">LAST NAME</th>
                        <th class="col">EVENT</th>
                        <th class="col">ROLE</th>
                        {{-- REMARKS
                            --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($volunteers as $volunteer)
                        <tr scope="row" class="align-middle">
                            <td> 
                                <button class="btn btn-outline-danger btn-modal" 
                                data-bs-toggle="modal" 
                                data-bs-target="#image"
                                data-volunteer_photo="{{ $volunteer->proof_of_checkout }}">
                                    IMAGE
                                </button>
                            </td>
                            <td> {{ ucwords($volunteer->first_name) }} </td>
                            <td> {{ ucwords($volunteer->last_name) }} </td>
                            <td> {{ $volunteer->title }}</td>
                            <td> {{ $volunteer->role }} </td>
                        </tr>
                    @endforeach
                </tbody>
                @include('layouts.image-modal')
            </table>
        </div>
        {{ $volunteers->Links() }}
        <script src="{{ asset('js/image-modal.js') }}"></script>
    </div>
@endsection
