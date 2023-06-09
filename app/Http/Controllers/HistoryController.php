<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RaceCode;
use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\VolunteerStatus;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function show()
    {
        $joined_events = VolunteerStatus::leftJoin('event', 'volunteer_status.event_id', '=', 'event.event_id')
            ->leftJoin('staff', 'volunteer_status.staff_id', '=', 'staff.staff_id')
            ->where('volunteer_id', Auth::user()->volunteer_id)
            ->where(function ($query) {
                $query->where('attendance_status', 'validated')
                    ->orWhere('attendance_status', 'cancelled');
            })
            ->get();

        $claimed_code_events = RaceCode::leftJoin('event', 'race_code.event_id', '=', 'event.event_id')
            ->leftJoin('race_types', 'race_code.race_id', '=', 'race_types.race_id')
            ->where('race_code.volunteer_id', Auth::user()->volunteer_id)
            ->where('race_code.status', 'claimed')
            ->get();

        $claiming_code_events_race_credits_val = RaceCode::leftJoin('race_credit', 'race_code.credit_id', '=', 'race_credit.credit_id')
            ->leftJoin('event', 'race_credit.event_id', '=', 'event.event_id')
            ->where('race_code.volunteer_id', Auth::user()->volunteer_id)
            ->where('race_code.status', 'claimed')
            ->get();

        return view('history', compact('joined_events', 'claimed_code_events','claiming_code_events_race_credits_val'));
    }


}