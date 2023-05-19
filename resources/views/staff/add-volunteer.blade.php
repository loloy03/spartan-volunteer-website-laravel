@extends('layouts.auth-navbar')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/table-style.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5">
        <form action="/add-volunteer" method="POST">
            @csrf
            <div>
                <h1> EVENT: {{ $event->first()->title }} </h1>
                <h5> DATE EVENT: {{ $event->first()->date }} </h5>
                <h6> LOCATION: {{ $event->first()->location }} </h6>
                <h6> EVENT ID: {{ $event->first()->event_id }} </h6>
            </div>
            <div class="table-responsive custom-table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th class="col">ADD TO ROLE</th>
                            <th class="col">FIRST NAME</th>
                            <th class="col">LAST NAME</th>
                            <th class="col">OCCUPATION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($volunteers as $volunteer)
                            <tr scope="row" class="table-row align-middle">
                                <td scope="row">
                                    <div class="form-check d-flex justify-content-center">
                                        <input type="checkbox" class="form-check-input input checkbox" />
                                    </div>
                                </td>
                                <td> {{ ucwords($volunteer->first_name) }} </td>
                                <td> {{ ucwords($volunteer->last_name) }} </td>
                                {{-- <td> {{ ucwords($volunteer->occupation) }}</td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
        <div>
            {{ $volunteers->links() }}
        </div>
        <script src="{{ asset('js/table-row.js') }}"></script>
        <script src="{{ asset('js/persisting-data.js') }}"></script>
    </div>
@endsection
