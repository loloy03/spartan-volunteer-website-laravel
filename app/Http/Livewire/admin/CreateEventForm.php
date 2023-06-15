<?php

namespace App\Http\Livewire\Admin;

use App\Models\Staff;
use App\Models\Events;
use App\Models\Races;
use App\Models\RaceType;
use App\Models\EventRole;
use App\Models\StaffStatus;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CreateEventForm extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $image;

    public $searchStaffName;

    public $title, $description, $location;
    public $date, $regStart, $regEnd, $claimStart, $claimEnd;

    public $currentRoleId;

    // raceId => race_type 
    public $races = [];

    // roleId => [staffId]
    public $roles = [];

    // roleId => roleCount
    public $rolePopulation = [];

    public function render()
    {
        $spartanRoles = $this->getSpartanRoles();

        $getStaffQuery = $this->getStaffs();
        
        $raceTypes = $this->getRaces();

        $this->search($getStaffQuery);

        $staffs = $getStaffQuery->paginate(5);

        return view('livewire.admin.create-event-form', compact('staffs', 'raceTypes', 'spartanRoles'));
    }

    protected $rules = [
        'title' =>  'required',
        'description' => 'required',
        'location' => 'required',
        'date' => 'required',
        'regStart' => 'required',
        'regEnd' => 'required',
        'claimStart' => 'required',
        'claimEnd' => 'required'
    ];

    // creates event
    public function submit()
    {
        $this->validate();

        DB::transaction( function () {
            $title = ucwords($this->title);
            $description = $this->formatParagraph($this->description);
            $location = ucwords($this->location);
    
            $filePath = 'images/event_thumbnails';
            $fileType = '.' . $this->image->getClientOriginalExtension();
            $fileName = 'thumbnail_' . $title . '-' . $this->date . $fileType;
    
            $this->image->storeAs($filePath, $fileName, 'public');
            // $this->image->move(public_path('images'), $fileName);

            $event = Events::create([
                'event_pic' => $fileName,
                'title' => $title,
                'description' => $description,
                'location' => $location,
                'start_date' => $this->regStart,
                'end_date' => $this->regEnd,
                'date' => $this->date,
                'code_start_date' => $this->claimStart,
                'code_end_date' => $this->claimEnd
            ]);
    
            // event id of newly created event
            $eventId = $event->event_id;
            $eventRoles = $this->getSpartanRoles();
    
            // insert Event Race
            foreach ($this->races as $raceId => $raceType) {
                Races::insert([
                    'event_id' => $eventId,
                    'race_id' => $raceId
                ]);
            }
    
            foreach ($this->roles as $roleId => $staffIds) {
                foreach ($staffIds as $staffId)
                {
                    // insert Staffs and Roles
                    StaffStatus::insert([
                        'staff_id' => $staffId,
                        'event_id' => $eventId,
                        'role' => $eventRoles[$roleId], 
                    ]);
                }
            }
        });

        return redirect('/event');
    }

    public function addStaff($staffRoleId, $staffId)
    {
        $this->roles[$staffRoleId][] = $staffId;
    }

    public function addRace($raceId, $raceType)
    {
        $this->races[$raceId] = $raceType;
    }

    public function removeRace($raceId)
    {
        unset($this->races[$raceId]);
        array_values($this->races);
    }

    public function removeStaff($roleId, $staffId)
    {
        if (isset($this->roles[$roleId])) {
            $index = array_search($staffId, $this->roles[$roleId]);
            if ($index !== false) {
                unset($this->roles[$roleId][$index]);
                $this->roles[$roleId] = array_values($this->roles[$roleId]);
            }
        }
    }    

    public function getStaffs()
    {
        return Staff::query();
    }

    public function setCurrentRoleId($roleId)
    {
        $this->currentRoleId = $roleId;
    }

    public function getRaces()
    {
        return RaceType::all();
    }

    public function getSpartanRoles()
    {
        return config('spartan_files.event-roles');
    }

    public function search($query)
    {
        if ($this->searchStaffName) {
            $query->where('first_name', 'LIKE', '%' . $this->searchStaffName . '%');
            // ->orWhere('last_name', 'LIKE', '%' . $this->searchStaffName . '%');
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function formatParagraph($input)
    {
        $output = preg_replace_callback('/([.!?])\s*(\w)/', function ($matches) {
            return strtoupper($matches[1] . ' ' . $matches[2]);
        }, ucfirst(strtolower($input)));
        return $output;
    }

    public function formatFileName($input)
    {
        $input = preg_replace('/[^a-zA-Z0-9\s]/', '', $input);

        $input = str_replace(' ', '_', $input);

        $input = strtolower($input);

        $output = $input . '(' . $this->regStart . ')';

        return $output;
    }
}
