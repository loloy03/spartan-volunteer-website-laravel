@extends('layouts.auth-navbar')

@section('import-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/table-style.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5 overflow-hidden">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col">PICTURE PROOF</th>
                        <th class="col">STATUS</th>
                        <th class="col">FIRST NAME</th>
                        <th class="col">LAST NAME</th>
                        <th class="col">EVENT</th>
                        <th class="col">CHECK-IN</th>
                        <th class="col">CHECK-OUT</th>
                        <th class="col">ROLE</th>
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
                            <td scope="row">
                                <label>
                                    <input type="checkbox" class="checkbox" />
                                    <div class="control__indicator"></div>
                                </label>
                            </td>
                            <td> {{ ucwords($volunteer->first_name) }} </td>
                            <td> {{ ucwords($volunteer->last_name) }} </td>
                            <td> {{ $volunteer->title }}</td>
                            <td> {{ $volunteer->check_in }}</td>
                            <td> {{ $volunteer->check_out }}</td>
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

