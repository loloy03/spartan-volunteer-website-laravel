<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Volunteer;
use App\Models\StaffStatus;
use App\Models\Staff;
use App\Models\RaceType;
use App\Services\CreateEventService;
use App\Models\VolunteerStatus;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VolunteerStatusController;
use App\Models\RaceCode;
use App\Models\RaceCredit;
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
        $sort_by = 'date_asc';

        // Override the sort order if the form was submitted
        if ($request->has('sort_by')) {
            $sort_by = $request->input('sort_by');
        }

        // Fetch the events from the database
        $events = Events::where('date', '>=', date('Y-m-d'));
        $picked_sort = "";

        // Sort the events according to the selected option
        switch ($sort_by) {
            case 'date_asc':
                $events->orderBy('date', 'asc');
                $picked_sort = "DATE (WILL START SOON)";
                break;
            case 'date_desc':
                $events->orderBy('date', 'desc');
                $picked_sort = "DATE (NEWEST FIRST)";
                break;
            case 'title_asc':
                $events->orderBy('title', 'asc');
                $picked_sort = "TITLE (A-Z)";
                break;
            case 'title_desc':
                $events->orderBy('title', 'desc');
                $picked_sort = "TITLE (Z-A)";
                break;
            case 'recent_events':
                $events = Events::where('date', '<', date('Y-m-d'));
                $picked_sort = "RECENT EVENTS";
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
        $categories = config('spartanfiles.event-categories');
        $staffs = Staff::select('staff_id', 'first_name', 'last_name')->paginate(5);
        return view('admin.create-event', compact('categories', 'staffs'));
    }

    /**
     * Display the specified resource.
     */

    public function show(Events $event)
    {
        // Format the event date to Month Day, Year
        $date = date('M j, Y', strtotime($event->date));

        // Check if today's date is within the event start and end date
        $today = date('Y-m-d');
        $event_start_date = $event->start_date;
        $event_end_date = $event->end_date;
        $code_start_date = $event->code_start_date;
        $code_end_date = $event->code_end_date;

        // if user is staff or admin
        if (Auth::guard('staff')->check() || Auth::guard('admin')->check()) {
            $races = Races::where('event_id', $event->event_id)->get();

            return view(
                'admin-staff-view-event',
                compact(
                    'event',
                    'date',
                    'event_start_date',
                    'event_end_date',
                    'code_start_date',
                    'code_end_date',
                    'races'
                )
            );
        }

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

        // Get the volunteer's attendance status for the event
        $attendance_status = VolunteerStatus::where('volunteer_id', Auth::user()->volunteer_id)
            ->where('event_id', $event->event_id)
            ->value('attendance_status');

        $isClaimed = RaceCode::where('volunteer_id', Auth::user()->volunteer_id)
            ->where('event_id', $event->event_id)
            ->value('status');

        //race credit value
        $r_credit_value = 3500;


        // If volunteer has cancelled their attendance, update event and code status accordingly
        if ($attendance_status == 'cancelled') {
            $event_status = 'VOLUNTEER CANCELLED';
            $code_status = 'NOT AVAILABLE';
        } elseif ($attendance_status == 'confirmed' || $attendance_status == 'checked' || $attendance_status == 'validated') {
            return redirect(route('join-as-volunteer', $event->event_id));
        } elseif ($isClaimed != null) {

            return redirect(route('claim_code.show', $event->event_id));
        }


        $races = Races::join('race_types', 'races.race_id', '=', 'race_types.race_id')
            ->where('event_id', $event->event_id)->get();

        // Format event and code start/end dates to Month Day format
        $event_start_date = date('M j', strtotime($event->start_date));
        $event_end_date = date('M j', strtotime($event->end_date));
        $code_start_date = date('M j', strtotime($event->code_start_date));
        $code_end_date = date('M j', strtotime($event->code_end_date));

        $race_credit_quantity = RaceCredit::where('volunteer_id', Auth::user()->volunteer_id)
            ->where('status', '=', 'unclaimed')
            ->count();

        $race_credits = RaceCredit::leftjoin('event','race_credit.event_id', '=', 'event.event_id')
        ->where('volunteer_id', Auth::user()->volunteer_id)
        ->where('status', '=', 'unclaimed')
        ->get();

        return view(
            'view-event',
            compact(

                'event',
                'date',
                'event_status',
                'event_start_date',
                'event_end_date',
                'code_start_date',
                'code_end_date',
                'code_status',
                'attendance_status',
                'races',
                'r_credit_value',
                'race_credit_quantity',
                'race_credits'
            )
        );
    }

    public function getEventTitle($eventId)
    {
        $eventTitle = Events::where('event_id', $eventId)->get('title');
        return $eventTitle->first()->title;
    }

    // IMPORTANT: STAFF ROLE
    // list of volunteers that are available to be given a role
    public function listOfConfirmedVolunteers($eventId)
    {
        $event = Events::where('event_id', $eventId)->first();

        $staffId = auth()->guard('staff')->user()->staff_id;

        $role = StaffStatus::where('staff_id', $staffId)
            ->where('event_id', $eventId)
            ->first();

        // resources\views\livewire\staff\partials\not-included.blade.php
        if ($role == null) {
            return view('livewire.staff.partials.not-included');
        }

        $staffRole = ucwords($role->role);

        return view('staff.add-volunteer', compact('staffId', 'staffRole', 'event'));
    }

    // IMPORTANT: STAFF ROLE
    // list of volunteers that have 'finished' their volunteer hours
    // to be validated by staff
    // NOTE: change event_id as argument
    public function listOfPendingVolunteers($eventId)
    {
        $event = Events::where('event_id', $eventId)->first();

        $staffId = auth()->guard('staff')->user()->staff_id;

        $role = StaffStatus::where('staff_id', $staffId)
            ->where('event_id', $eventId)
            ->first();

        // resources\views\livewire\staff\partials\not-included.blade.php
        if ($role == null) {
            return view('livewire.staff.partials.not-included');
        }

        $staffRole = ucwords($role->role);

        return view('staff.check-attendance', compact('staffId', 'staffRole', 'event'));
    }

    public function listOfVolunteerRace($eventId)
    {
        $event = Events::find($eventId);
        return view('admin.volunteer-racecode-claim', compact('event'));
    }

    public function listOfEventVolunteers($eventId)
    {
        $event = Events::find($eventId);
        return view('admin.event-volunteers', compact('event'));
    }

    public function listOfEventStaffs($eventId)
    {
        $event = Events::find($eventId);
        return view('admin.event-staffs', compact('event'));
    }
}
