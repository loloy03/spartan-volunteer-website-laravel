@extends('layouts.app')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/table-style.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5 overflow-hidden">
        <form action="{{ route('check-attendance.post', $event->event_id) }}" method="POST" wire:submit.prevent="submit">
            @csrf
            
            @include('staff.partials.event-info')

            <div class="shadow p-3 mb-5 bg-white rounded">
                @livewire('staff.check-attendance-table', ['staffId' => $staffId, 'staffRole' => $staffRole,'eventId' => $event->event_id])
            </div>
        </form>
    </div>
@endsection
