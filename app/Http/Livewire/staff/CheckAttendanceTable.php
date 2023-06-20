<?php

namespace App\Http\Livewire\Staff;

use App\Models\RaceCredit;
use App\Models\Volunteer;
use App\Models\VolunteerStatus;
use App\Models\Events;

use Livewire\Component;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;

class CheckAttendanceTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $eventId;
    public $staffId;
    public $staffRole;

    // search item
    public $searchFirstName;
    public $searchLastName;

    // filter item
    public $filterStatus;

    public $checked = [];
    public $validated = [];

    // sorting items
    // defualt sort(volunteer_id, asc)
    public $sortBy = 'volunteer_id'; // sort by: first_name, last_name, occupation
    public $sortDirection = 'asc';

    public function render()
    {
        $query = $this->queryBuilder();

        $this->search($query);

        $this->filter($query);

        $volunteers = $query->paginate(10);

        return view('livewire.staff.check-attendance-table', compact('volunteers'));
    }

    public function queryBuilder()
    {
        return Volunteer::query()->join('volunteer_status', 'volunteer.volunteer_id', '=', 'volunteer_status.volunteer_id')
        ->where('volunteer_status.event_id', $this->eventId)
        ->where('volunteer_status.staff_id', $this->staffId)
        ->where('volunteer_status.role', $this->staffRole)
        ->orderBy($this->sortBy, $this->sortDirection)
        ->select(
            'volunteer.volunteer_id',
            'volunteer.first_name',
            'volunteer.last_name',
            'volunteer.contact_number',
            'volunteer_status.role',
            'volunteer_status.staff_id',
            'volunteer_status.attendance_status',
            'volunteer_status.check_in',
            'volunteer_status.check_out',
            'volunteer_status.proof_of_checkout'
        );
    }

    // Sort query
    public function search($query)
    {
        if ($this->searchFirstName) {
            $query->where('first_name', 'LIKE', '%' . $this->searchFirstName . '%');
        }

        if ($this->searchLastName) {
            $query->where('last_name', 'LIKE', '%' . $this->searchLastName . '%');
        }
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function checkAttendance()
    {
        $checkedVolunteers = $this->checked;

        if($checkedVolunteers)
        {
            foreach($checkedVolunteers as $volunteer)
            {
                VolunteerStatus::where('volunteer_id', $volunteer)
                ->where('event_id', $this->eventId)
                ->update(['attendance_status' => 'checked']);
            }
        }
    }

    public function validateAttendance()
    {
        $validatedVolunteers = $this->validated;
        $event = Events::find($this->eventId);

        $eventDate = Carbon::createFromFormat('Y-m-d', $event->date);
        $expDate = $eventDate->addYear();

        if($validatedVolunteers)
        {
            foreach($validatedVolunteers as $volunteer)
            {
                DB::transaction( function () use ($volunteer, $expDate) {
                        RaceCredit::insert([
                        'volunteer_id' => $volunteer,
                        'event_id' => $this->eventId,
                        'exp_date' => $expDate,
                        'status' => 'unclaimed'
                    ]);

                });
            }
        }
    }

    // Sort query
    public function sort($column)
    {
        if ($this->sortBy === $column)
        {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        
        $this->sortBy = $column;
    }

    public function filter($query)
    {
        if ($this->filterStatus)
        {
            $query->where('attendance_status', $this->filterStatus);
        }
    }

    public function mount($eventId, $staffId, $staffRole)
    {
        $this->eventId = $eventId;
        $this->staffId = $staffId;
        $this->staffRole = $staffRole;
    }
}
