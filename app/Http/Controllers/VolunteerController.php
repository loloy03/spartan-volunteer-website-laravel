<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\Events;
use App\Models\VolunteerStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VolunteerController extends Controller
{
    // IMPORTANT: STAFF ROLE
    // list of volunteers that are available to be given a role
    public function listOfConfirmedVolunteers() {
        $volunteers = Volunteer::select('volunteer.first_name', 'volunteer.last_name', 'event.title', 
        'volunteer_status.attendance_status')
                        ->join('volunteer_status', 'volunteer.volunteer_id', '=', 'volunteer_status.volunteer_id')
                        ->join('event', 'volunteer_status.event_id', '=', 'event.event_id')
                        ->whereNull('volunteer_status.role')
                        ->where('volunteer_status.attendance_status', 'confirmed')
                        ->paginate(20);
        
        return view('staff.add-volunteer', compact('volunteers'));
    }

    // IMPORTANT: STAFF ROLE
    // list of volunteers that have 'finished' their volunteer hours
    // to be validated by staff
    // NOTE: change event_id as argument
    public function listOfPendingVolunteers() {
        $volunteers = Volunteer::select('volunteer.volunteer_id', 'volunteer.first_name', 'volunteer.last_name', 'event.title', 'volunteer_status.role',
        'volunteer_status.attendance_status', 'volunteer_status.check_in', 'volunteer_status.check_out', 
        'volunteer_status.proof_of_checkout')
                        ->join('volunteer_status', 'volunteer.volunteer_id', '=', 'volunteer_status.volunteer_id')
                        ->join('event', 'volunteer_status.event_id', '=', 'event.event_id')
                        ->where('volunteer_status.attendance_status', 'confirmed')
                        ->whereNotNull('volunteer_status.role')
                        ->whereNotNull('volunteer_status.check_in')
                        ->whereNotNull('volunteer_status.check_out')
                        ->paginate(20);

        return view('staff.check-attendance', compact('volunteers'));
    }
    
    // IMPORTANT!: ADMIN ROLE
    // list of volunteers that have verified their attendance
    // they are now eligible to claim their free race codes
    // NOTE: checked === verified
    public function listofVerifiedVolunteers() {
        $volunteers = Volunteer::select('volunteer.first_name', 'volunteer.last_name', 'event.title', 'volunteer_status.role',
        'volunteer_status.attendance_status', 'volunteer_status.check_in', 'volunteer_status.check_out', 
        'volunteer_status.proof_of_checkout')
                        ->join('volunteer_status', 'volunteer.volunteer_id', '=', 'volunteer_status.volunteer_id')
                        ->join('event', 'volunteer_status.event_id', '=', 'event.event_id')
                        ->where('volunteer_status.attendance_status', 'checked')
                        ->whereNotNull('volunteer_status.role')
                        ->whereNotNull('volunteer_status.check_in')
                        ->whereNotNull('volunteer_status.check_out')
                        ->paginate(20);
        return view('admin.distribute-code', compact('volunteers'));
    }
}
