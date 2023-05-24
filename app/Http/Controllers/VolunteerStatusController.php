<?php

namespace App\Http\Controllers;

use App\Models\VolunteerStatus;
use Illuminate\Http\Request;

class VolunteerStatusController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'volunteer_id' => 'required|numeric',
            'volunteer_fullname' => 'required|string',
            'event_id' => 'required|numeric',
        ]);

        // Create a new VolunteerStatus object and set its properties
        $volunteerStatus = new VolunteerStatus();
        $volunteerStatus->volunteer_id = $validatedData['volunteer_id'];
        $volunteerStatus->full_name = $validatedData['volunteer_fullname'];
        $volunteerStatus->event_id = $validatedData['event_id'];
        $volunteerStatus->attendance_status = "joining";
        $volunteerStatus->save();

        // Redirect the user back to the previous page
        return redirect()->back();
    }

    public function cancelled(Request $request)
    {
        // Validate input parameters
        $validatedData = $request->validate([
            'volunteer_id' => 'required|numeric',
            'event_id' => 'required|numeric',
        ]);

        // Search for VolunteerStatus object associated with volunteer_id and event_id
        $volunteerStatus = VolunteerStatus::where('volunteer_id', $validatedData['volunteer_id'])
            ->where('event_id', $validatedData['event_id'])
            ->first();

        // If found, set attendance_status to "cancelled" and save changes
        if ($volunteerStatus) {
            $volunteerStatus->attendance_status = "cancelled";
            $volunteerStatus->save();
        }

        // Redirect back to previous page
        return redirect()->back();
    }

    public function confirmed(Request $request)
    {
        // Validate input parameters
        $validatedData = $request->validate([
            'volunteer_id' => 'required|numeric',
            'event_id' => 'required|numeric',
        ]);

        // Search for VolunteerStatus object associated with volunteer_id and event_id
        $volunteerStatus = VolunteerStatus::where('volunteer_id', $validatedData['volunteer_id'])
            ->where('event_id', $validatedData['event_id'])
            ->first();

        // If found, set attendance_status to "cancelled" and save changes
        if ($volunteerStatus) {
            $volunteerStatus->attendance_status = "confirmed";
            $volunteerStatus->save();
        }

        // Redirect back to previous page
        return redirect(route('join-as-volunteer', $request->event_id));
    }

    //
}


// elseif($attendance_status == 'confirmed'){
//     redirect( route('join-as-volunteer',$event->event_id) );
// }