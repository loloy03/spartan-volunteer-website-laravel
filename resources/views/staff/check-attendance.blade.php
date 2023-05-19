@extends('layouts.auth-navbar')

@section('import-js')
    
@endsection

@section('import-css')
    <!-- Import the custom event.css file -->
    <link href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('/css/table-style.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5 overflow-hidden">
        <form action="/{{ $event->first()->event_id }}/check-attendance" method="POST">
            @csrf
            <div>
                <h1> EVENT: {{ $event->first()->title }} </h1>
                <h5> DATE EVENT: {{ $event->first()->date }} </h5>
                <h6> LOCATION: {{ $event->first()->location }} </h6>
                <h6> EVENT ID: {{ $event->first()->event_id }} </h6>
            </div>
            <div>
                <h6> COUNT: {{ count($volunteers) }} VOLUNTEERS</h3>
            </div>
            <div class="table-responsive custom-table-responsive">
                <table class="table custom-table" id="table">
                    <thead>
                        <tr>
                            <th class="col">PICTURE PROOF</th>
                            <th class="col">STATUS</th>
                            <th class="col">NAME</th>
                            <th class="col">EVENT</th>
                            <th class="col">CHECK-IN</th>
                            <th class="col">CHECK-OUT</th>
                            <th class="col">ROLE</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($volunteers as $volunteer)
                            <tr scope="row" class="align-middle table-group-divider">
                                <td>
                                    <button type="button" class="btn btn-dark btn-modal" data-bs-toggle="modal"
                                        data-bs-target="#image" data-volunteer_photo="{{ $volunteer->proof_of_checkout }}">
                                        IMAGE
                                    </button>
                                </td>
                                <td scope="row">
                                    <select class="form-select" name="volunteer-status[{{ $volunteer->volunteer_id }}]"
                                        id="status">
                                        <option selected disabled>Status...</option>
                                        <option value="checked">CHECKED</option>
                                        <option value="validated">VALIDATED</option>
                                    </select>
                                </td>
                                <td> {{ ucwords($volunteer->first_name) ." ". ucwords($volunteer->last_name)}} </td>
                                
                                <td> {{ $volunteer->title }}</td>
                                <td> {{ date('H:i:s', strtotime($volunteer->check_in)) }}</td>
                                <td> {{ date('H:i:s', strtotime($volunteer->check_out)) }}</td>
                                <td> {{ $volunteer->role }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @include('layouts.image-modal')
                </table>
            </div>
        </form>
        <div>
            {{ $volunteers->links() }}
        </div>
        <script src="{{ asset('js/image-modal.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('js/data-table.js') }}"></script>
    </div>
@endsection
