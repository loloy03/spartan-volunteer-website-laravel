<?php

namespace App\Services;

use App\Models\Events;
use App\Models\EventCategory;
use App\Models\StaffStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CreateEventService {
    public function createEvent(Request $request)
    {
        $directory = 'images/events';
        Storage::makeDirectory($directory);

        $image = $request->file('event_pic');
        $fileName = $image->getClientOriginalName();

        // $image->move(public_path($directory), $fileName);

        if ($validatedEvent = $request->validate([
            'event_pic' => 'required|image|dimensions:min_width=480,min_height=360',
            'title' => 'required|min:0|max:45',
            'description' => 'required|min:0|max:255',
            'location' => 'required|min:0|max:45',
            'start_date' => 'required',
            'end_date' => 'required',
            //'status' => 'required',
            'date' => 'required',
            'event_date_end' => 'event_date_end',
            'code_start_date' => 'required',
            'code_end_date' => 'required'
        ])) {
            $image->move(public_path($directory), $fileName);
            $event = Events::create($validatedEvent);

            // Save the event categories
            $this->insertEventCategory($request, $event->event_id);

            // Save staff assigned to roles
            // Insert to staff_status table
            $this->insertStaffStatus($request, $event->event_id);
        }
    }

    public function insertEventCategory(Request $request, $eventId)
    {
        $categories = $request->input('category.event-categories');
        if ($categories) {
            $eventCategories = [];
            foreach ($categories as $category) {
                $eventCategories[] = [
                    'event_id' => $eventId,
                    'category' => $category
                ];
            }
            EventCategory::insert($eventCategories);
        }
    }

    public function insertStaffStatus(Request $request, $eventId)
    {
        // Save staff assigned to roles
        $staffStatus = $request->input('staff-status');
        if ($staffStatus) {
            $staffStatuses = [];
            foreach ($staffStatus as $staffId => $statusId) {
                $staffStatuses[] = [
                    'staff_id' => $staffId,
                    'event_id' => $eventId,
                    'status_id' => $statusId
                ];
            }
            StaffStatus::insert($staffStatuses);
        }
    }
}
