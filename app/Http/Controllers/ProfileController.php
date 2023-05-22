<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\VolunteerStatus;
use App\Models\RaceCode;
use App\Models\RaceCredit;
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
            ->whereNotIn('attendance_status', ['validated', 'cancelled'])
            ->get();


        $claiming_code_events = RaceCode::leftJoin('event', 'race_code.event_id', '=', 'event.event_id')
            ->leftJoin('race_types', 'race_code.race_id', '=', 'race_types.race_id')
            ->where('race_code.volunteer_id', Auth::user()->volunteer_id)
            ->where('race_code.status', '!=', 'released')
            ->get();

        $race_credit = RaceCredit::where('volunteer_id', Auth::user()->volunteer_id)
            ->where('status','=','unclaimed')
            ->get();
        $race_credit_quantity = $race_credit->count();

        // Pass event data and status variables to the view
        return view('profile', compact('joining_events', 'claiming_code_events','race_credit_quantity'));
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
            'emergency_contact_name' => 'nullable',
            'emergency_number' => 'nullable',
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
            'street_add' => 'nullable',
            'country' => 'nullable',
            'city' => 'nullable',
            'zip' => 'nullable',
            'second_add' => 'nullable',
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
            'selected_date' => 'nullable|date',
            'contact_number' => 'nullable',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Rest of the code for updating the user's profile
        if ($request->hasFile('photo')) {
            // Get the uploaded file
            $file = $request->file('photo');

            // Set a unique file name based on the current timestamp and the file extension
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            // Remove the previous profile picture file if it exists
            if ($user->profile_picture) {
                $previousFilePath = public_path('images') . '/' . $user->profile_picture;
                if (file_exists($previousFilePath)) {
                    unlink($previousFilePath);
                }
            }

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