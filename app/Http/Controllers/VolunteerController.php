<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\Events;
use App\Models\StaffStatus;
use App\Models\VolunteerStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VolunteerController extends Controller
{
    // IMPORTANT: STAFF ROLE
    // list of volunteers that are available to be given a role
    public function listOfConfirmedVolunteers($eventId)
    {
        // NOTE: SHOULD PUT THIS IN OWN CONTROLLER AND PASS TO VIEW VIA ROUTES
        $event = Events::where('event_id', $eventId)->get();

        $volunteers = Volunteer::select(
            'volunteer.volunteer_id',
            'volunteer.first_name',
            'volunteer.last_name',
            'volunteer.occupation',
            'event.title',
            'volunteer_status.event_id',
            'volunteer_status.attendance_status'
        )   
            ->join('volunteer_status', 'volunteer.volunteer_id', '=', 'volunteer_status.volunteer_id')
            ->join('event', 'volunteer_status.event_id', '=', 'event.event_id')
            ->whereNull('volunteer_status.role')
            ->where('volunteer_status.event_id', $eventId)
            ->where('volunteer_status.attendance_status', 'confirmed')
            ->paginate(20);

        return view('staff.add-volunteer', compact('volunteers', 'event'));
    }

    // Update list of volunteers with the current Staff's role
    // If current Staff role for the event is Registration, Staff can update 
    // volunteer role to Registration
    public function updateConfirmedVolunteers(Request $request, $eventId)
    {
        $volunteerId = $request->input('volunteer-id');
        $staffId = auth()->guard('staff')->user()->staff_id;
        
        $role = StaffStatus::where('staff_id', $staffId)
        ->where('event_id', $eventId)
        ->first();

        $volunteerRole = ucwords($role->first()->role);

        if($volunteerId) {
            foreach($volunteerId as $id) {
                VolunteerStatus::updateOrInsert(
                    // WHERE CLAUSE
                    ['volunteer_id' => $id, 'event_id' => $eventId],
                    // INSERT or UPDATE CLAUSE
                    ['role' => $volunteerRole, 'staff_id' => $staffId],
                );
            }
        }
        return redirect('/'.$eventId.'/add-volunteer');
    }

    // IMPORTANT: STAFF ROLE
    // list of volunteers that have 'finished' their volunteer hours
    // to be validated by staff
    // NOTE: change event_id as argument
    public function listOfPendingVolunteers($eventId)
    {
        $event = Events::where('event_id', $eventId)->get();
        $staffId = auth()->guard('staff')->user()->staff_id;

        $role = StaffStatus::where('staff_id', $staffId)
        ->where('event_id', $eventId)
        ->first();

        $staffRole = ucwords($role->role);

        // dd($event, $staffId, $staffRole);
        
        $volunteers = Volunteer::select(
            'volunteer.volunteer_id',
            'volunteer.first_name',
            'volunteer.last_name',
            'event.title',
            'volunteer_status.event_id',
            'volunteer_status.role',
            'volunteer_status.attendance_status',
            'volunteer_status.check_in',
            'volunteer_status.check_out',
            'volunteer_status.proof_of_checkout'
        )
            ->join('volunteer_status', 'volunteer.volunteer_id', '=', 'volunteer_status.volunteer_id')
            ->join('event', 'volunteer_status.event_id', '=', 'event.event_id')
            ->where('volunteer_status.attendance_status', 'confirmed')
            ->where('event.event_id', $eventId)
            ->where('volunteer_status.role', $staffRole)
            // ->whereNotNull('volunteer_status.check_in')
            // ->whereNotNull('volunteer_status.check_out')
            ->paginate(20);
        //dd($volunteers);
        return view('staff.check-attendance', compact('volunteers', 'event'));
    }

    // Updates the listOfPendingVolunteers()
    // Updates attendance_status to CHECKED or VALIDATED
    public function updatePendingVolunteers(Request $request, $eventId)
    {
        $volunteerStatus = $request->input('volunteer-status');
        $staffId = auth()->guard('staff')->user()->staff_id;

        if($volunteerStatus) {
            foreach($volunteerStatus as $volunteerId => $status) {
                VolunteerStatus::updateOrInsert(
                    // WHERE CLAUSE
                    ['volunteer_id' => $volunteerId /*, 'event_id' => $eventId*/],
                    // INSERT or UPDATE CLAUSE
                    ['attendance_status' => $status /*, 'staff_id' => $staffId*/]
                );
            }
            //dd($volunteerStatuses);
        }
        return redirect('/'.$eventId.'/check-attendance');
    }

    // IMPORTANT!: ADMIN ROLE
    // list of volunteers that have verified their attendance
    // they are now eligible to claim their free race codes
    // NOTE: checked === verified
    public function listofVerifiedVolunteers()
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
            ->whereNotNull('volunteer_status.check_out')
            ->paginate(20);
        return view('admin.distribute-code', compact('volunteers'));
    }
}
