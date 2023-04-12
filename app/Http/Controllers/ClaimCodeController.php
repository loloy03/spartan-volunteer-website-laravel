<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\RaceCode;
use App\Models\Races;
use App\Models\VolunteerStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClaimCodeController extends Controller
{



    public function store_race_type(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'volunteer_id' => 'required|numeric',
            'event_id' => 'required|numeric',
            'race_type' => 'required'
        ]);

        // Delete all existing races for the current event when the volunteer picked a race
        Races::where('event_id', $validatedData['event_id'])->delete();

        // Create a new RaceCode object and set its properties
        $race_code = new RaceCode();
        $race_code->volunteer_id = $validatedData['volunteer_id'];
        $race_code->event_id = $validatedData['event_id'];
        $race_code->race_type = $validatedData['race_type'];
        $race_code->status = 'pending';
        $race_code->save();

        // Redirect the user back to the previous page
        return redirect(route('claim_code.show', $request->event_id));
    }


    public function show(Events $event)
    {
        // Format the event date to Month Day, Year
        $date = date('F jS', strtotime($event->date));

        // Check if today's date is within the event start and end date
        $today = date('Y-m-d');

        $status = RaceCode::where('volunteer_id', Auth::user()->volunteer_id)
            ->where('event_id', $event->event_id)
            ->value('status');

        $race_type = RaceCode::where('volunteer_id', Auth::user()->volunteer_id)
            ->where('event_id', $event->event_id)
            ->value('race_type');

        $race_code = RaceCode::where('volunteer_id', Auth::user()->volunteer_id)
            ->where('event_id', $event->event_id)
            ->value('race_code');


        // Pass event data and status variables to the 
        return view('claim-code', compact(
            'event',
            'date',
            'today',
            'status',
            'race_type',
            'race_code'
        ));
    }
}
