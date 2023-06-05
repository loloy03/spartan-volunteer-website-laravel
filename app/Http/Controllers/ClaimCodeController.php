<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\RaceCode;
use App\Models\RaceCredit;
use App\Models\Races;
use App\Models\VolunteerStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClaimCodeController extends Controller
{
    public function upload_receipt(Request $request)
    {
        // Validate the uploaded file
        $validatedData = $request->validate([
            'volunteer_id' => 'required|numeric',
            'event_id' => 'required|numeric',
            'photo' => 'nullable',
        ]);

        if ($request->hasFile('photo')) {
            // Get the uploaded file
            $file = $request->file('photo');

            // Set a unique file name based on the current timestamp and the file extension
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            // Save the file to the "images" folder in the public directory
            $file->move(public_path('images'), $fileName);

            $raceCode = RaceCode::where('volunteer_id', $validatedData['volunteer_id'])
                ->where('event_id', $validatedData['event_id'])
                ->first();

            if ($raceCode) {
                $raceCode->receipt = $fileName;
                $raceCode->status = "pending";
                $raceCode->save();
            }

            // Redirect back to the previous page with a success message
            return redirect()->back()->with('success', 'Receipt uploaded successfully.');
        } else {
            // Handle the case when no file is uploaded
            return redirect()->back()->with('error', 'No file uploaded.');
        }
    }



    // public function confirm(Request $request)
    // {
    //     // Validate the uploaded file
    //     $validatedData = $request->validate([
    //         'volunteer_id' => 'required|numeric',
    //         'event_id' => 'required|numeric',
    //     ]);

    //     $raceCode = RaceCode::where('volunteer_id', $validatedData['volunteer_id'])
    //         ->where('event_id', $validatedData['event_id'])
    //         ->first();


    //     if ($raceCode) {
    //         $raceCode->status = "pending";
    //         $raceCode->save();
    //     }

    //     // Redirect back to the previous page with a success message
    //     return redirect()->back()->with('success', 'Receipt uploaded successfully.');
    // }


    // public function cancel(Request $request)
    // {
    //     // Validate the input data
    //     $validatedData = $request->validate([
    //         'volunteer_id' => 'required|numeric',
    //         'event_id' => 'required|numeric',
    //     ]);

    //     // Find the existing race code in the database
    //     $race_code = RaceCode::where([
    //         'volunteer_id' => $validatedData['volunteer_id'],
    //         'event_id' => $validatedData['event_id'],
    //     ])->first();

    //     if ($race_code) {
    //         // Delete the race code from the database
    //         $race_code->delete();
    //     }

    //     // Redirect the user back to the previous page
    //     return redirect(route('view-event', $request->event_id));
    // }




    public function store_race_type(Request $request)
    {
        $validatedData = $request->validate([
            'volunteer_id' => 'required|numeric',
            'event_id' => 'required|numeric',
            'race_id' => 'required',
            'credit_id' => 'required',
            'photo' => 'nullable',
        ]);

        // Changing the unclaimed to claimed
        RaceCredit::where('volunteer_id', Auth::user()->volunteer_id)
            ->where('credit_id', $validatedData['credit_id'])
            ->update(['status' => 'claimed']);


        // Create a new RaceCode object and set its properties
        $race_code = new RaceCode();
        $race_code->volunteer_id = $validatedData['volunteer_id'];
        $race_code->event_id = $validatedData['event_id'];
        $race_code->race_id = $validatedData['race_id'];
        $race_code->credit_id = $validatedData['credit_id'];
        if ($request->hasFile('photo')) {
            // Get the uploaded file
            $file = $request->file('photo');

            // Set a unique file name based on the current timestamp and the file extension
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            // Save the file to the "images" folder in the public directory
            $file->move(public_path('images'), $fileName);
        } else {
            $race_code->remarks = 'asd';
            $fileName = null;
        }
        $race_code->receipt = $fileName;
        $race_code->status = 'pending';
        $race_code->save();

        // Redirect the user back to the previous page
        return redirect()->route('claim_code.show', $request->event_id);
    }




    public function show(Events $event)
    {
        // Format the event date to Month Day, Year
        $date = date('F jS', strtotime($event->date));

        // Check if today's date is within the event start and end date
        $today = date('Y-m-d');

        // Retrieve the race type for the event
        $race_type = RaceCode::join('race_types', 'race_code.race_id', '=', 'race_types.race_id')
            ->where('event_id', $event->event_id)
            ->value('race_type');

        $race_price = RaceCode::join('race_types', 'race_code.race_id', '=', 'race_types.race_id')
            ->where('event_id', $event->event_id)
            ->value('price');

        // Retrieve the races_code
        $race_code = RaceCode::where('event_id', $event->event_id)->first();

        $r_credit_value = 3500;

        // Pass event data, date, today's date, race type, and races to the view
        return view('claim-code', compact('event', 'date', 'today', 'race_type', 'race_code', 'race_price', 'r_credit_value'));
    }

}