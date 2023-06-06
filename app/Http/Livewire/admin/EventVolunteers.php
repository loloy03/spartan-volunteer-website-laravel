<?php

namespace App\Http\Livewire\Admin;

use App\Models\Volunteer;

use Livewire\WithPagination;

use Livewire\Component;

class EventVolunteers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $eventId;

    // search item
    public $searchFirstName;
    public $searchLastName;

    // filter item
    public $filterStatus;

    // sorting items
    // defualt sort(volunteer_id, asc)
    public $sortBy = 'volunteer_id'; // sort by: first_name, last_name, occupation
    public $sortDirection = 'asc';

    public function render()
    {
        return view('livewire.admin.event-volunteers');
    }

    public function queryBuilder()
    {
        return Volunteer::query()->join('volunteer_status', 'volunteer.volunteer_id', '=', 'volunteer_status.volunteer_id')
        ->where('volunteer_status.event_id', $this->eventId)
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

    public function updatedSearch()
    {
        $this->resetPage();
    }

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

    public function mount($eventId)
    {
        $this->eventId = $eventId;
    }
}
