<?php

namespace App\Http\Livewire\Admin;

use App\Models\Volunteer;

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

        return view('livewire.admin.admin-volunteers-table', compact('volunteers'));
    }

    // Sql query 
    public function queryBuilder()
    {
        return Volunteer::query()->join('volunteer_status', 'volunteer.volunteer_id', '=', 'volunteer_status.volunteer_id')
            ->join('event', 'event.event_id', '=', 'volunteer_status.event_id')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->select(
                'volunteer.volunteer_id',
                'volunteer.first_name',
                'volunteer.last_name',
                'event.title',
                'event.location',
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

        if ($this->searchEvent) {
            $query->where('title', 'LIKE', '%' . $this->searchEvent . '%');
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
}
