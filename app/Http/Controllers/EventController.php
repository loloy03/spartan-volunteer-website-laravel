<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\VolunteerStatus;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VolunteerStatusController;
use Illuminate\Console\Scheduling\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch the latest 10 events from the database
        $events = Events::latest('date')->paginate(10);

        // Format the date of each event in the collection
        $events->getCollection()->transform(function ($event) {
            $event->date = Carbon::parse($event->date)->format('F jS Y');
            return $event;
        });

        // // Get the volunteer's attendance status for the event
        // $attendance_status = VolunteerStatus::where('volunteer_id', Auth::user()->volunteer_id)
        //     ->where('event_id', $event->event_id)
        //     ->value('attendance_status');

        // Render the view with the events and the current page number
        return view('event', compact('events'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    // public function check_attendance_status($volunteer_id,$event_id)
    // {
    //     $attendance_status = VolunteerStatus::where('volunteer_id', $volunteer_id)
    //     ->where('event_id', $event_id)
    //     ->value('attendance_status');

    //     return $attendance_status;
    // }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     */

    public function show(Events $event)
    {
        // Format the event date to Month Day, Year
        $date = date('F jS, Y', strtotime($event->date));

        // Check if today's date is within the event start and end date
        $today = date('Y-m-d');
        $event_start_date = $event->start_date;
        $event_end_date = $event->end_date;
        $code_start_date = $event->code_start_date;
        $code_end_date = $event->code_end_date;

        // Initialize variables to hold event and code status
        $event_status = '';
        $code_status = '';

        // Check event availability status
        if ($today < $event_start_date || $today > $event_end_date) {
            $event_status = 'NOT AVAILABLE';
        } else {
            $event_status = 'AVAILABLE';
        }

        // Check code availability status
        if ($today < $code_start_date || $today > $code_end_date) {
            $code_status = 'NOT AVAILABLE';
        } else {
            $code_status = 'AVAILABLE';
        }

        // Format event and code start/end dates to Month Day format
        $event_start_date = date('F jS', strtotime($event->start_date));
        $event_end_date = date('F jS', strtotime($event->end_date));
        $code_start_date = date('F jS', strtotime($event->code_start_date));
        $code_end_date = date('F jS', strtotime($event->code_end_date));

        // Get the volunteer's attendance status for the event
        $attendance_status = VolunteerStatus::where('volunteer_id', Auth::user()->volunteer_id)
            ->where('event_id', $event->event_id)
            ->value('attendance_status');

        // If volunteer has cancelled their attendance, update event and code status accordingly
        if ($attendance_status == 'cancelled') {
            $event_status = 'VOLUNTEER CANCELLED';
            $code_status = 'NOT AVAILABLE';
        }elseif ($attendance_status== 'confirmed') {
            return redirect( route('join-as-volunteer',$event->event_id) );
        }

        // Pass event data and status variables to the view
        return view('view-event', compact(
            'event',
            'date',
            'event_status',
            'event_start_date',
            'event_end_date',
            'code_start_date',
            'code_end_date',
            'code_status',
            'attendance_status'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Events $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Events $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Events $event)
    {
        //
    }
}
