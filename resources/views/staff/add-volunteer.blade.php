@extends('layouts.app')

@section('import-js')
    <script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/table-style.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5">
        <form action="{{ route('add-volunteer.post', $event->event_id) }}" method="POST" wire:submit.prevent="submit">
            @csrf

            @include('staff.partials.event-info')
            
            <div class="shadow p-3 mb-5 bg-white rounded">
                    @livewire('staff.add-volunteers-table', ['staffId' => $staffId, 'staffRole' => $staffRole,'eventId' => $event->event_id])
                </div>
            </form>
        </div>
@endsection
