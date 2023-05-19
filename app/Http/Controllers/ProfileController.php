<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\VolunteerStatus;
use App\Models\RaceCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class ProfileController extends Controller
{
    public function show(Volunteer $volunteer)
    {
        $joining_events = VolunteerStatus::leftJoin('event', 'volunteer_status.event_id', '=', 'event.event_id')
            ->leftJoin('staff', 'volunteer_status.staff_id', '=', 'staff.staff_id')
            ->where('volunteer_id', Auth::user()->volunteer_id)
            ->where('attendance_status', '!=', 'validated')
            ->get();

        $claiming_code_events = RaceCode::leftJoin('event', 'race_code.event_id', '=', 'event.event_id')
            ->leftJoin('race_types', 'race_code.race_id', '=', 'race_types.race_id')
            ->where('race_code.volunteer_id', Auth::user()->volunteer_id)
            ->where('race_code.status', '!=', 'released')
            ->get();



        // Pass event data and status variables to the view
        return view('profile', compact('joining_events', 'claiming_code_events'));
    }


    public function volunteer_info_edit()
    {
        return view('edit-profile');
    }

    public function address_edit()
    {
        return view('edit-address');
    }

    public function contact_edit()
    {
        return view('edit-contact');
    }

    public function contact_update(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'emergency_contact_name' => 'required',
            'emergency_number' => 'required',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update the user's profile with the new data
        $user->emergency_contact_name = $validatedData['emergency_contact_name'];
        $user->emergency_number = $validatedData['emergency_number'];
        $user->save();

        // Redirect the user back to their profile page with a success message
        return redirect()->route('profile.show')->with('success', 'Emergency Contact updated successfully.');
    }

    public function address_update(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'street_add' => 'required',
            'country' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'second_add' => 'required',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update the user's profile with the new data
        $user->street_add = $validatedData['street_add'];
        $user->country = $validatedData['country'];
        $user->city = $validatedData['city'];
        $user->zip = $validatedData['zip'];
        $user->second_add = $validatedData['second_add'];
        $user->save();

        // Redirect the user back to their profile page with a success message
        return redirect()->route('profile.show')->with('success', 'Address updated successfully.');
    }

    public function volunteer_info_update(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'selected_date' => 'required|date',
            'contact_number' => 'required',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Convert the updated_at and created_at timestamps to Carbon instances
        $updatedDate = Carbon::parse($user->updated_at);
        $createdDate = Carbon::parse($user->created_at);

        // Calculate the allowed update date (30 days after the last update or registration)
        $allowedUpdateDate = $updatedDate ?? $createdDate;

        // Set the allowed update date as the current date if both timestamps are null
        if ($allowedUpdateDate === null) {
            $allowedUpdateDate = now();
        } else {
            $allowedUpdateDate = $allowedUpdateDate->addDays(30);
        }

        // Check if the current date is within the allowed update period
        if (now()->lt($allowedUpdateDate)) {
            // Calculate the remaining days until the next update is allowed
            $remainingDays = now()->diffInDays($allowedUpdateDate);

            // Redirect the user back to their profile page with an error message
            return redirect()->route('profile.show')->with('error', 'You can update your information again in ' . $remainingDays . ' days.');
        }

        // Rest of the code for updating the user's profile
        if ($request->hasFile('photo')) {
            // Get the uploaded file
            $file = $request->file('photo');

            // Set a unique file name based on the current timestamp and the file extension
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            // Save the file to the "images" folder in the public directory
            $file->move(public_path('images'), $fileName);

            // Update the user's profile picture with the new file name
            $user->profile_picture = $fileName;
        }

        // Update the user's profile with the new data
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->birthdate = date('Y-m-d', strtotime($validatedData['selected_date']));
        $user->contact_number = $validatedData['contact_number'];
        $user->updated_at = now()->toDateTimeString(); // Update the updated_at timestamp
        $user->save();

        // Redirect the user back to their profile page with a success message
        return redirect()->route('profile.show')->with('success', 'Volunteer Info updated successfully.');
    }


}

