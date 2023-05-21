@extends('layouts.app')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('/css/table-style.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5">
        <form action="{{ route('add-volunteer.post', $event->first()->event_id) }}" method="POST">
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
                            <th class="col no-sort">ADD TO ROLE</th>
                            <th class="col">FIRST NAME</th>
                            <th class="col">OCCUPATION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($volunteers as $volunteer)
                            <tr scope="row" class="table-row align-middle">
                                <td scope="row">
                                    <div class="form-check d-flex justify-content-center">
                                        <input type="checkbox" class="form-check-input input checkbox" 
                                        name="volunteer-id[]" value="{{ $volunteer->volunteer_id }}"
                                        />
                                    </div>
                                </td>
                                <td> {{ ucwords($volunteer->first_name) . " " . ucwords($volunteer->last_name)}} </td>
                                <td> {{ ucwords($volunteer->occupation) }}</td>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('js/data-table.js') }}"></script>
    </div>
@endsection
