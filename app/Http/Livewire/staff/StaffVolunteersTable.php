<?php

namespace App\Http\Livewire\Staff;

use App\Models\Volunteer;

use Livewire\Component;
use Livewire\WithPagination;

class StaffVolunteersTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $staffId;

    // search item
    public $searchFirstName;
    public $searchLastName;
    public $searchLocation;
    public $searchEvent;
    public $searchRole;

    // filter item
    public $filterStatus;

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

        return view('livewire.staff.staff-volunteers-table', compact('volunteers'));
    }

    // Sql query 
    public function queryBuilder()
    {
        return Volunteer::query()->join('volunteer_status', 'volunteer.volunteer_id', '=', 'volunteer_status.volunteer_id')
        ->join('event', 'volunteer_status.event_id', '=', 'event.event_id')
        ->where('volunteer_status.staff_id', $this->staffId)
        ->orderBy($this->sortBy, $this->sortDirection)
        ->select(
            'volunteer.volunteer_id',
            'volunteer.first_name',
            'volunteer.last_name',
            'event.title',
            'event.location',
            'event.date',
            'volunteer_status.role',
            'volunteer_status.check_in',
            'volunteer_status.check_out',
            'volunteer_status.attendance_status',
        );
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

        if ($this->searchLocation) {
            $query->where('location', 'LIKE', '%' . $this->searchLocation . '%');
        }

        if ($this->searchRole) {
            $query->where('role', 'LIKE', '%' . $this->searchRole . '%');
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    // Sort query
    public function sort($column)
    {
        if ($this->sortBy === $column) {
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

    public function mount($staffId)
    {
        $this->staffId = $staffId;
    }
}
