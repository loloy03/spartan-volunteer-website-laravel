<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\VolunteerStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JoinAsVolunteerController extends Controller
{

    public function upload_photo(Request $request)
    {
        // Validate the uploaded file
        $validatedData = $request->validate([
            'volunteer_id' => 'required|numeric',
            'event_id' => 'required|numeric',
            'photo' => 'required',
        ]);

        // Get the uploaded file
        $file = $request->file('photo');

        // Set a unique file name based on the current timestamp and the file extension
        $fileName = time() . '.' . $file->getClientOriginalExtension();


        $volunteerStatus = VolunteerStatus::where('volunteer_id', $validatedData['volunteer_id'])
            ->where('event_id', $validatedData['event_id'])
            ->first();

        // If found, set attendance_status to "cancelled" and save changes
        if ($volunteerStatus) {
            $volunteerStatus->proof_of_checkout = $fileName;
            $volunteerStatus->save();
        }


        // Save the file to the "images" folder in the public directory
        $file->move(public_path('images'), $fileName);

        // Redirect back to the previous page with a success message
        return redirect()->back()->with('success', 'Photo uploaded successfully.');
    }

    public function check_in(Request $request)
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
            $volunteerStatus->check_in = date('Y-m-d H:i:s');
            $volunteerStatus->save();
        }

        // Redirect back to previous page
        return redirect()->back();
    }

    public function check_out(Request $request)
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
            $volunteerStatus->check_out = date('Y-m-d H:i:s');
            $volunteerStatus->save();
        }

        // Redirect back to previous page
        return redirect()->back();
    }


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

        $staff = VolunteerStatus::join('staff', 'volunteer_status.staff_id', '=', 'staff.staff_id')
            ->where('volunteer_status.volunteer_id', Auth::user()->volunteer_id)
            ->where('volunteer_status.event_id', $event->event_id)
            ->select('staff.first_name', 'staff.last_name')
            ->first();


        $check_in = VolunteerStatus::where('volunteer_id', Auth::user()->volunteer_id)
            ->where('event_id', $event->event_id)
            ->value('check_in');

        $check_out = VolunteerStatus::where('volunteer_id', Auth::user()->volunteer_id)
            ->where('event_id', $event->event_id)
            ->value('check_out');

        $proof_of_checkout = VolunteerStatus::where('volunteer_id', Auth::user()->volunteer_id)
            ->where('event_id', $event->event_id)
            ->value('proof_of_checkout');

        // Pass event data and status variables to the view
        return view(
            'join-as-volunteer',
            compact(
                'event',
                'date',
                'attendance_status',
                'today',
                'role',
                'check_in',
                'check_out',
                'proof_of_checkout',
                'staff'
            )
        );
    }
}