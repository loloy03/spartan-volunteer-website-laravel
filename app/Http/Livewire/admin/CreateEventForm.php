<?php

namespace App\Http\Livewire\Admin;

use App\Models\Staff;
use App\Models\Events;
use App\Models\Races;
use App\Models\RaceType;

use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CreateEventForm extends Component
{
    use WithFileUploads;

    public $image;
    public $title, $description, $location;
    public $regStart, $regEnd, $claimStart, $claimEnd;
    public $races = [];
    public $roles = [];

    public function render()
    {
        $staffs = $this->getStaffs();
        return view('livewire.admin.create-event-form', compact('staffs'));
    }

    protected $rules = [
        'image' => 'required',
        'title' =>  'required',
        'description' => 'required',
        'location' => 'required',
        'regStart' => 'required',
        'regEnd' => 'required',
        'claimStart' => 'required',
        'claimEnd' => 'required'
    ];

    // creates event
    public function createEvent()
    {
        // validates inputs
        try {
            $this->validate();

            $fileName = $this->image->getClientOriginalName();

            DB::transaction(function () {
                Events::create([
                    'event_pic' => $this->image,
                    'title' => ucwords($this->title),
                    'descrption' => $this->formatParagraph($this->description),
                    'location' => ucwords($this->location),
                    'start_date' => $this->regStart,
                    'end_date' => $this->regEnd,
                    'date' => $this->date,
                    'code_start_date' => $this->claimStart,
                    'code_end_date' => $this->claimEnd
                ]);
                // insert Event Race
                

                // insert Event Staffs


            });
        } 
        catch (ValidationException $e) {
            //
        }
    }

    public function getStaffs()
    {
        return Staff::all();
    }

    public function getRaces()
    {
        return RaceType::all();
    }

    public function formatParagraph($input)
    {
        $output = preg_replace_callback('/([.!?])\s*(\w)/', function ($matches) {
            return strtoupper($matches[1] . ' ' . $matches[2]);
        }, ucfirst(strtolower($input)));
        return $output;
    }
}
