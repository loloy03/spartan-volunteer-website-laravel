@extends('layouts.app')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/css/table-style.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5">
        <form action="{{ route('add-volunteer.post', $event->event_id) }}" method="POST">
            @csrf
            <div>
                <h1> EVENT: {{ $event->title }} </h1>
                <h5> DATE EVENT: {{ $event->date }} </h5>
                <h6> LOCATION: {{ $event->location }} </h6>
                <h6> EVENT ID: {{ $event->event_id }} </h6>
            </div>
            <div class="shadow p-3 mb-5 bg-white rounded">
                <div class="table-responsive custom-table-responsive">
                    <table class="table custom-table" id="">
                        <thead>
                            <h6> COUNT: {{ count($volunteers) }} VOLUNTEERS</h3>
                                <tr>
                                    <th class="col no-sort">ADD TO ROLE</th>
                                    <th class="col" sortable>FIRST NAME</th>
                                    <th class="col" sortable>OCCUPATION</th>
                                </tr>
                        </thead>
                        <tbody>
                            @foreach ($volunteers as $volunteer)
                                <tr scope="row" class="table-row align-middle">
                                    <td scope="row">
                                        <div class="form-check d-flex justify-content-center">
                                            <input type="checkbox" class="form-check-input input checkbox"
                                                name="volunteer-id[]" value="{{ $volunteer->volunteer_id }}" />
                                        </div>
                                    </td>
                                    <td> {{ ucwords($volunteer->first_name) . ' ' . ucwords($volunteer->last_name) }} </td>
                                    <td> {{ ucwords($volunteer->occupation) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <script src="{{ asset('js/table-row.js') }}"></script>
        <script src="{{ asset('js/persisting-data.js') }}"></script>
    </div>
@endsection
