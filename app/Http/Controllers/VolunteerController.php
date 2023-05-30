<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\Events;
use App\Models\StaffStatus;
use App\Models\VolunteerStatus;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function adminListOfVolunteers()
    {
        return view('admin.admin-volunteers');
    }

    // IMPORTANT!: ADMIN ROLE
    // list of volunteers that have verified their attendance
    // they are now eligible to claim their free race codes
    public function listofValidatedVolunteers()
    {
        $volunteers = Volunteer::select(
            'volunteer.first_name',
            'volunteer.last_name',
            'event.title',
            'volunteer_status.role',
            'volunteer_status.attendance_status',
            'volunteer_status.check_in',
            'volunteer_status.check_out',
            'volunteer_status.proof_of_checkout'
        )
            ->join('volunteer_status', 'volunteer.volunteer_id', '=', 'volunteer_status.volunteer_id')
            ->join('event', 'volunteer_status.event_id', '=', 'event.event_id')
            ->where('volunteer_status.attendance_status', 'checked')
            ->whereNotNull('volunteer_status.role')
            ->whereNotNull('volunteer_status.check_in')
            ->whereNotNull('volunteer_status.check_out');

        return view('admin.volunteer-racecode', compact('volunteers'));
    }
}
