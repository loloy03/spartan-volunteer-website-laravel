<?php

namespace App\Http\Livewire\Staff;

use App\Models\Volunteer;
use App\Models\VolunteerStatus;
use App\Models\StaffStatus;

use Livewire\Component;
use Livewire\WithPagination;

class AddVolunteersTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $staffId;
    public $staffRole;

    public $eventId;
    public $selectedCheckboxes = [];

    // search item
    public $searchFirstName;
    public $searchLastName;
    public $searchOccupation;

    // sorting items
    // defualt sort(volunteer_id, asc)
    public $sortBy = 'volunteer_id'; // sort by: first_name, last_name, occupation
    public $sortDirection = 'asc';
    
    // Renders query / table view
    public function render()
    {
        $query = $this->queryBuilder($this->eventId);

        $this->search($query);

        $volunteers = $query->paginate(10);

        return view('livewire.staff.add-volunteers-table', compact('volunteers'));
    }

    // Sql query 
    public function queryBuilder($eventId)
    {
        return Volunteer::query()->join('volunteer_status', 'volunteer.volunteer_id', '=', 'volunteer_status.volunteer_id')
        ->whereNull('volunteer_status.role')
        ->where('volunteer_status.event_id', $eventId)
        ->where('volunteer_status.attendance_status', 'confirmed')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->select(
            'volunteer.volunteer_id',
            'volunteer.first_name',
            'volunteer.last_name',
            'volunteer.occupation',
            'volunteer_status.event_id',
            'volunteer_status.attendance_status',
        );
    }

    public function updateVolunteers()
    {
        $volunteers = $this->selectedCheckboxes;

        if($volunteers) {
            foreach($volunteers as $volunteer) {
                VolunteerStatus::updateOrInsert(
                    // WHERE CLAUSE
                    ['volunteer_id' => $volunteer, 'event_id' => $this->eventId],
                    // INSERT or UPDATE CLAUSE
                    ['role' => $this->staffRole, 'staff_id' => $this->staffId],
                );
            }
        }
    }

    // Search query
    public function search($query)
    {
        if ($this->searchFirstName) {
            $query->where('first_name', 'LIKE', '%' . $this->searchFirstName . '%');
        }

        if ($this->searchLastName) {
            $query->where('last_name', 'LIKE', '%' . $this->searchLastName . '%');
        }

        if ($this->searchOccupation) {
            $query->where('occupation', 'LIKE', '%' . $this->searchOccupation . '%');
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
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

    public function mount($eventId)
    {
        $this->eventId = $eventId;
    }
}
