@extends('layouts.app')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/table-style.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5 overflow-hidden">
        <form wire:submit.prevent="submit">
            @csrf

            @include('admin.partials.event-info')
            
            <div class="shadow p-3 mb-5 bg-white rounded">
                @livewire('admin.volunteer-race-code-table', ['eventId' => $event->event_id])
            </div>
        </form>
    </div>
@endsection
