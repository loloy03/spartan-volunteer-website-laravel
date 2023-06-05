<?php

namespace App\Http\Livewire\Admin;

use App\Models\Volunteer;
use App\Models\RaceCode;

use Livewire\Component;
use Livewire\WithPagination;

class VolunteerRaceCodeTable extends Component
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

    public $eventId;

    public function render()
    {
        $query = $this->queryBuilder();

        $this->search($query);

        $this->filter($query);
        
        $volunteers = $query->paginate(10);

        return view('livewire.admin.volunteer-race-code-table', compact('volunteers'));
    }

    public function mount($eventId)
    {
        $this->eventId = $eventId;
    }

    public function queryBuilder()
    {
        return RaceCode::query()->join('volunteer', 'volunteer.volunteer_id', '=', 'race_code.volunteer_id')
        ->join('race_types', 'race_types.race_id', '=', 'race_code.race_id')
        ->join('event', 'event.event_id', '=', 'race_code.event_id')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->where('event.event_id', $this->eventId)
        ->select(
            'race_code.volunteer_id',
            'first_name',
            'last_name',
            'email',
            'title',
            'race_type',
            'receipt',
            'volunteer.r_credits',
            'status'
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

        // if ($this->searchEvent) {
        //     $query->where('title', 'LIKE', '%' . $this->searchEvent . '%');
        // }

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
            $query->where('status', $this->filterStatus);
        }
    }
}