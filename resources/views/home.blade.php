@extends('layouts.app')

@section('import-css')
    <link rel="stylesheet" href="{{ asset('/css/home.css') }}">
@endsection

@section('content')
    <div class="home-pic h-100vh">
        <div class="container-fluid">
            <img src="{{ asset('/images/spartan-home-pic.jpg') }}" alt="home-pic">
            <div class="text-overlay">
                <div class="f-montserrat display-4 transparent-text">
                    {{ __('BE A VOLUNTEER NOW') }}
                </div>
                <div class="f-montserrat float-start mt-2">
                    <button type="button" class="find-event-button"
                        onclick="window.location='{{ route('event') }}'">{{ __('JOIN & RACE FREE') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="p-5">
            <div class="fs-1 f-druk-wide mb-3">VOLUNTEER PERKS</div>
            <div class="f-lato">Along with the awesome feeling of helping your fellow Spartans, there are some sweet
                perks
                to being a Spartan Volunteer.
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="p-4">
                        <img class="home-card-pic" src="{{ asset('/images/spartan-home-card-pic-1.jpg') }}" alt="home-pic">
                        <div class="f-lato">
                            Free entry to a volunteer heat in a Sprint 5K, City 5K, Stadion 5K, Super 10K or Beast 21K
                            in
                            the
                            Philippines
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="p-4">
                        <img class="home-card-pic" src="{{ asset('/images/spartan-home-card-pic-2.jpg') }}" alt="home-pic">
                        <div class="f-lato">A free Spartan volunteer t-shirt, snacks and festival entry on the day you
                            volunteer. </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="p-4">
                        <img class="home-card-pic" src="{{ asset('/images/spartan-home-card-pic-3.jpg') }}" alt="home-pic">
                        <div class="f-lato">
                            An exclusive behind-the-scenes look at how Spartan races operate and being part of changing
                            lives
                            around the world.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="home-pic h-100vh">
        <img src="{{ asset('/images/spartan-home-pic-dark.jpg') }}" alt="home-pic">
        <div class="text-overlay">
            <div class="f-montserrat display-6">
                {{ __('MEET NEW PEOPLE BEING A PART OF THE TEAM, SOCIALIZING AND EARNING A FREE RACE,') }}
            </div>
            <div class="f-montserrat float-start mt-2">
                <button type="button" class="find-event-button"
                    onclick="window.location='{{ route('event') }}'">{{ __('COMMIT NOW') }}</button>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="p-5">
            <div class="fs-1 f-druk-wide my-5">VOLUNTEER ROLES</div>
            <div class="row px-3">
                <div class="col-lg-6 mt-4">
                    <div class="bg-light-gray p-5 h-100">
                        <div class="f-montserrat fs-3">
                            ON-COURSE
                        </div>
                        <div class="f-lato mt-4">
                            Help our build crew on race days by instructing and motivating racers through the course. You
                            will be responsible for serving as our eyes and ears on the course, including reporting any
                            injuries by radio to our medical team (training provided on site).
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4">
                    <div class="bg-light-gray p-5 h-100">
                        <div class="f-montserrat fs-3">
                            FESTIVAL
                        </div>
                        <div class="f-lato mt-4">
                            Assist our Festival Team at the finish line, start corral, bag check, merchandise and throughout
                            the festival. Be ready to give lots of high-fives!
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4">
                    <div class="bg-light-gray p-5 h-100">
                        <div class="f-montserrat fs-3">
                            REGIST-RATION
                        </div>
                        <div class="f-lato mt-4">
                            Help our Registration Staff greet, check-in and answer questions for racers and spectators. This
                            job requires the use of a Spartan computer. You will receive training for the first 30-minutes
                            of your volunteer shift by our Registration Lead.
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-4">
                    <div class="bg-light-gray p-5 h-100">
                        <div class="f-montserrat fs-3">
                            OBSTACLE OFFICIALS
                        </div>
                        <div class="f-lato mt-4">
                            Ensure all elite & age group competitors complete obstacles in accordance to the rules and
                            enforce the penalties if they don’t. Help maintain the current and future integrity of the
                            sport! You will use both photo and video equipment.
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-4">
                    <div class="bg-light-gray p-5 h-100">
                        <div class="f-montserrat fs-3">
                            PRE-RUNNER
                        </div>
                        <div class="f-lato mt-4">
                            Run the course pre-race to ensure weather (or animals!) have not disrupt the course overnight.
                            NOTE: as some mornings are dark, we ask that you bring your own headlamp. Upon completion, you
                            will be reassigned to on-course until the end of your shift.
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-4">
                    <div class="bg-light-gray p-5 h-100">
                        <div class="f-montserrat fs-3">
                            PRE/POST RACE
                        </div>
                        <div class="f-lato mt-4">
                            Help basecamp build obstacles on course, setup tents & fence lines, along with other race
                            critical festival tasks. All Load In, Build & Load Out volunteers are provided with a homemade
                            meal for lunch, and a $50 merch credit for use at our online store.
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-4">
                    <div class="bg-light-gray p-5 h-100">
                        <div class="f-montserrat fs-3">
                            KIDS RACE
                        </div>
                        <div class="f-lato mt-4">
                            Assist our Kids Race team on race day(s) with overall production and safety of the Kids Race
                            event. Encourage our little Spartans through the course!
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-4">
                    <div class="bg-light-gray p-5 h-100">
                        <div class="f-montserrat fs-3">
                            CHOOSE YOUR SHIFT
                        </div>
                        <div class="f-lato mt-4">
                            Meet the community
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <div class="p-5 mt-5">
            <div class="display-5 f-druk-wide mb-3 ">HAVE A QUESTION?</div>
            <div class="f-lato my-3">
                Need an answer to a question? Contact us at
                <div class="d-inline-block">
                    <p><a class="text-danger" href="mailto:volunteer@spartanrace.com">volunteer@spartanrace.com</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
