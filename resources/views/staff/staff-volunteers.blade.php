@extends('layouts.app')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/table-style.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5">
        <div class="shadow p-3 mb-5 bg-white rounded">
            @livewire('staff.staff-volunteers-table', ['staffId' => $staffId])
        </div>
    </div>
@endsection