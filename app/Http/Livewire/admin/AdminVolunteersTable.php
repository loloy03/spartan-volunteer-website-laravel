<?php

namespace App\Http\Livewire\Admin;

use App\Models\Volunteer;
use App\Models\RaceCredit;

use App\Exports\AdminVolunteersExport;
use Maatwebsite\Excel\Facades\Excel;

use Livewire\Component;
use Livewire\WithPagination;

class AdminVolunteersTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // search item
    public $searchFirstName;
    public $searchLastName;
    public $searchStaffFirstName;
    public $searchStaffLastName;
    public $searchEvent;
    public $searchLocation;
    public $searchRole;

    // filter item
    public $filterStatus;
    public $filterRaceCodeStatus;

    // sorting items
    // defualt sort(volunteer_id, asc)
    public $sortBy = 'volunteer_id'; // sort by: first_name, last_name, occupation
    public $sortDirection = 'asc';

    public function render()
    {
        $query = $this->queryBuilder();

        $this->search($query);

        $this->filter($query);

        $this->codeStatusFilter($query);
        
        $volunteers = $query->paginate(10);

        return view('livewire.admin.admin-volunteers-table', compact('volunteers'));
    }

    // Sql query 
    public function queryBuilder()
    {
        return RaceCredit::query()->join('volunteer_status', 'race_credit.volunteer_id', '=', 'volunteer_status.volunteer_id')
        ->join('volunteer', 'volunteer_status.volunteer_id', '=', 'volunteer.volunteer_id')
        ->join('race_code', 'race_credit.credit_id', '=', 'race_code.credit_id')
        ->join('race_types', 'race_code.race_id', '=', 'race_types.race_id')
        ->join('event as event1', 'race_credit.event_id', '=', 'event1.event_id')
        ->join('event as event2', 'race_code.event_id', '=', 'event2.event_id')
        ->where('volunteer_status.attendance_status', '!=', 'cancelled')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->select(
            'volunteer.volunteer_id',
            'volunteer.first_name',
            'volunteer.last_name',
            'event1.title as event1_title' ,
            'event1.location as event1_location',
            'volunteer_status.role',
            'volunteer_status.attendance_status',
            'race_code.status as race_code_status',
            'race_types.race_type',
            'event2.title as event2_title',
            'event2.location as event2_location',
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

        if ($this->searchEvent) {
            $query->where('event1.title', 'LIKE', '%' . $this->searchEvent . '%');
        }

        if ($this->searchLocation) {
            $query->where('event1.location', 'LIKE', '%' . $this->searchLocation . '%');
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
        if ($this->filterStatus) {
            $query->where('attendance_status', $this->filterStatus);
        }
    }

    public function codeStatusFilter($query)
    {
        if ($this->filterRaceCodeStatus) {
            $query->where('race_code.status', $this->filterRaceCodeStatus);
        }
    }
}
