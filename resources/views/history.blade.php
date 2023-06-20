@extends('layouts.app')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/history.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="f-druk-wide display-5 my-5">HISTORY</div>

                @if (session('success'))
                    <div class="alert alert-success p-2 mt-2">
                        {{ session('success') }}
                    </div>
                @endif


                <div class="box-border-shadow-bt-red pb-4">
                    <div class="f-montserrat h4 m-4">JOINED EVENTS</div>
                    <div class="mx-3 mb-3">
                        @if ($joined_events->count() > 0)
                            @foreach ($joined_events as $event)
                                <div class="p-3">
                                    <div type="button" class="row p-3 bg-light-gray view-history-hover f-lato"
                                        onclick="window.location='{{ route('view-event', $event->event_id) }}'">
                                        <div class="col-lg-6 my-auto">
                                            <div class="d-block">
                                                {{-- format the date --}}
                                                {{ date('M j, Y', strtotime($event->date)) }}
                                            </div>

                                            <div class="d-block">
                                                <div class="fs-3 f-montserrat">
                                                    {{ $event->title }}
                                                </div>
                                            </div>
                                            <div class="d-block">
                                                <img src="/images/icons/pin-icon.png" width="15px">
                                                {{ $event->location }}
                                            </div>


                                        </div>
                                        <div class="col-lg-6 my-auto pt-3">

                                            <div class="d-block">
                                                <div class="d-inline-block f-montserrat">
                                                    Staff:
                                                </div>
                                                {{-- staff first name --}}
                                                {{ $event->first_name }}
                                            </div>
                                            <div class="d-block">
                                                <div class="d-inline-block f-montserrat">
                                                    Role:
                                                </div>
                                                {{ ucfirst($event->role) }}
                                            </div>

                                            <div class="d-block">
                                                <div class="d-inline-block f-montserrat">
                                                    Status:
                                                </div>
                                                {{-- event status --}}
                                                {{ ucfirst($event->attendance_status) }}
                                            </div>

                                            <div class="d-block">
                                                <div class="d-inline-block f-montserrat">
                                                    Checked In Time:
                                                </div>
                                                {{ $event->check_in }}
                                            </div>
                                            <div class="d-block">
                                                <div class="d-inline-block f-montserrat">
                                                    Checked Out Time:
                                                </div>
                                                {{ $event->check_out }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-lg-12 f-montserrat p-2">
                                <div class="bg-light-gray text-center">
                                    <p class="fs-4 pt-4 pb-4">NO EVENTS</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>


                <div class="box-border-shadow-bt-red my-5 pb-4">
                    <div class="f-montserrat h4 m-4">CLAIMED CODE EVENTS</div>
                    <div class="mx-3 mb-3">
                        @if ($claimed_code_events->count() > 0)
                            @foreach ($claimed_code_events as $event)
                                @foreach ($claiming_code_events_race_credits_val as $credits_val)
                                    <div class="p-3">
                                        <div type="button" class="row p-3 bg-light-gray f-lato view-history-hover"
                                            onclick="window.location='{{ route('view-event', $event->event_id) }}'">
                                            <div class="col-lg-6 my-auto">
                                                <div class="d-block">
                                                    {{-- format the date --}}
                                                    {{ date('M j, Y', strtotime($event->date)) }}
                                                </div>

                                                <div class="d-block">
                                                    <div class="fs-3 f-montserrat">
                                                        {{ $event->title }}
                                                    </div>
                                                </div>
                                                <div class="d-block">
                                                    <img src="/images/icons/pin-icon.png" width="15px">
                                                    {{ $event->location }}
                                                </div>
                                            </div>

                                            <div class="col-lg-6 my-auto pt-3">

                                                <div class="d-block">
                                                    <div class="d-inline-block f-montserrat">
                                                        Type of Race:
                                                    </div>
                                                    {{-- staff first name --}}
                                                    {{ ucfirst($event->race_type) }}
                                                </div>

                                                <div class="d-block">
                                                    <div class="d-inline-block f-montserrat">
                                                        Race Credit:
                                                    </div>
                                                    {{ ucfirst($credits_val->title) }}
                                                </div>

                                                <div class="d-block">
                                                    <div class="d-inline-block f-montserrat">
                                                        Status:
                                                    </div>
                                                    {{ ucfirst($event->status) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        @else
                            <div class="col-lg-12 f-montserrat p-2">
                                <div class="bg-light-gray text-center">
                                    <p class="fs-4 pt-4 pb-4">NO EVENTS</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-1"></div>
@endsection
