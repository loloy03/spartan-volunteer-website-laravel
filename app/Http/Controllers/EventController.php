<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\VolunteerStatus;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VolunteerStatusController;
use App\Models\RaceCode;
use App\Models\Races;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Define the default sort order
        $sort_by = 'date_desc';

        // Override the sort order if the form was submitted
        if ($request->has('sort_by')) {
            $sort_by = $request->input('sort_by');
        }

        // Fetch the events from the database
        $events = Events::where('date', '>', date('Y-m-d'));
        $picked_sort = "";

        // Sort the events according to the selected option
        switch ($sort_by) {
            case 'date_asc':
                $events->orderBy('date', 'asc');
                $picked_sort = "Date (oldest first)";
                break;
            case 'date_desc':
                $events->orderBy('date', 'desc');
                $picked_sort = "Date (newest first)";
                break;
            case 'title_asc':
                $events->orderBy('title', 'asc');
                $picked_sort = "Title (A-Z)";
                break;
            case 'title_desc':
                $events->orderBy('title', 'desc');
                $picked_sort = "Title (Z-A)";
                break;
            case 'all_events':
                $events = Events::where('date', '<', date('Y-m-d'));
                $picked_sort = "All Events";
                break;
            default:
                $events->latest('date');
        }

        // Paginate the events
        $events = $events->paginate(10);

        // Format the date of each event in the collection
        $events->getCollection()->transform(function ($event) {
            $event->date = Carbon::parse($event->date)->format('M j Y');
            return $event;
        });

        // Render the view with the events and the current page number
        return view('event', compact('events', 'picked_sort'))
            ->with('i', ($events->currentPage() - 1) * $events->perPage());
    }




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

        $isClaimed = RaceCode::where('volunteer_id', Auth::user()->volunteer_id)
            ->where('event_id', $event->event_id)
            ->value('status');


        // If volunteer has cancelled their attendance, update event and code status accordingly
        if ($attendance_status == 'cancelled') {
            $event_status = 'VOLUNTEER CANCELLED';
            $code_status = 'NOT AVAILABLE';
        } elseif ($attendance_status == 'confirmed') {
            return redirect(route('join-as-volunteer', $event->event_id));
        } elseif ($isClaimed != null) {

            return redirect(route('claim_code.show', $event->event_id));
        }


        $races = Races::where('event_id', $event->event_id)->get();

        return view('view-event', compact(
            'event',
            'date',
            'event_status',
            'event_start_date',
            'event_end_date',
            'code_start_date',
            'code_end_date',
            'code_status',
            'attendance_status',
            'races'
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
