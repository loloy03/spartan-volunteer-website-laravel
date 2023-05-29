@extends('layouts.app')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/table-style.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5 overflow-hidden">
        <form action="{{ route('check-attendance.post', $event->event_id) }}" method="POST" wire:submit.prevent="submit">
            @csrf
            <div class="shadow p-3 mb-5 bg-white rounded">
                <h1> EVENT: {{ $event->title }} </h1>
                <h5> DATE EVENT: {{ $event->date }} </h5>
                <h6> LOCATION: {{ $event->location }} </h6>
                <h5> EVENT ROLE: {{ $staffRole }} </h5>
            </div>
            <div class="shadow p-3 mb-5 bg-white rounded">
                {{-- <livewire:staff.validate-volunteers-table eventId="{{ $event->event_id }}"
                    staffRole="{{ $staffRole }}" /> --}}
                @livewire('staff.check-attendance-table', ['staffId' => $staffId, 'staffRole' => $staffRole,'eventId' => $event->event_id])
            </div>
        </form>
    </div>
@endsection
