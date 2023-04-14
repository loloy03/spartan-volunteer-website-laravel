<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(Volunteer $volunteer)
    {
        // Pass event data and status variables to the view
        return view('profile', compact(
            'volunteer'
        ));
    }

    public function edit()
    {
        return view('/edit-profile');
    }

    public function update(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'selected_date' => 'required|date',
            'contact_number' => 'required',
            'photo' => 'required'
        ]);


        // Get the uploaded file
        $file = $request->file('photo');

        // Set a unique file name based on the current timestamp and the file extension
        $fileName = time() . '.' . $file->getClientOriginalExtension();

        // Get the authenticated user
        $user = Auth::user();

        // Update the user's profile with the new data
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->birthdate = date('Y-m-d', strtotime($validatedData['selected_date']));
        $user->contact_number = $validatedData['contact_number'];
        $user->profile_picture = $fileName;
        $user->save();


        // Save the file to the "images" folder in the public directory
        $file->move(public_path('images'), $fileName);

        // Redirect the user back to their profile page with a success message
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
