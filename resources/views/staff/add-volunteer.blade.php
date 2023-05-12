@extends('layouts.app')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/table-style.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5">
        <div class="table-responsive custom-table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th class="col">ADD TO ROLE</th>
                        <th class="col">FIRST NAME</th>
                        <th class="col">LAST NAME</th>
                        <th class="col">OCCUPATION</th>
                        <th class="col">EVENT</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($volunteers as $volunteer)
                        <tr scope="row" class="table-row align-middle" >
                            <td scope="row">
                                <label>
                                    <input type="checkbox" class="input checkbox"/>
                                    <div class="control__indicator"></div>
                                </label>
                            </td>
                            <td> {{ ucwords($volunteer->first_name) }} </td>
                            <td> {{ ucwords($volunteer->last_name) }} </td>
                            <td></td>
                            <td> {{$volunteer->title}}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
        {{ $volunteers->Links() }}
        <script src="{{ asset('js/table-row.js') }}"></script>
        <script src="{{ asset('js/persisting-data.js') }}"></script>
    </div>
@endsection