<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\VolunteerStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JoinAsVolunteerController extends Controller
{
    public function show(Events $event)
    {
        // Format the event date to Month Day, Year
        $date = date('F jS', strtotime($event->date));

        // Check if today's date is within the event start and end date
        $today = date('Y-m-d');

        $attendance_status = VolunteerStatus::where('volunteer_id', Auth::user()->volunteer_id)
            ->where('event_id', $event->event_id)
            ->value('attendance_status');

        $role = VolunteerStatus::where('volunteer_id', Auth::user()->volunteer_id)
            ->where('event_id', $event->event_id)
            ->value('role');

        // Pass event data and status variables to the view
        return view('join-as-volunteer', compact(
            'event',
            'date',
            'attendance_status',
            'today',
            'role'
        ));
    }
}
