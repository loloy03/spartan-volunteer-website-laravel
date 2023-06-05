<?php

namespace App\Http\Livewire\Admin;

use App\Models\Staff;
use App\Models\Events;
use App\Models\Races;
use App\Models\RaceType;

use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CreateEventForm extends Component
{
    use WithFileUploads;

    public $image;
    public $title, $description, $location;
    public $regStart, $regEnd, $claimStart, $claimEnd;
    public $races = [];
    public $roles = [];

    protected $listeners = ['processImage' => 'handleProcessedImage'];

    public function render()
    {
        $staffs = $this->getStaffs();
        return view('livewire.admin.create-event-form', compact('staffs'));
    }

    protected $rules = [
        'title' =>  'required',
        'description' => 'required',
        'location' => 'required',
        'regStart' => 'required',
        'regEnd' => 'required',
        'claimStart' => 'required',
        'claimEnd' => 'required'
    ];

    // creates event
    public function submit()
    {
        $this->validate();

        $imageName = $this->formatFileName($this->title) . '.' . $this->image->extension();
        $imageName;
        $this->image->store('images', $imageName);

        Events::create([
            'event_pic' => $imageName,
            'title' => ucwords($this->title),
            'description' => $this->formatParagraph($this->description),
            'location' => ucwords($this->location),
            'start_date' => $this->regStart,
            'end_date' => $this->regEnd,
            'date' => $this->regStart,
            'code_start_date' => $this->claimStart,
            'code_end_date' => $this->claimEnd
        ]);
        // insert Event Race


        // insert Event Staffs
    }

    public function handleProcessedImage($imageData)
    {
        $this->image = $imageData;
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

    public function formatFileName($input)
    {
        $input = preg_replace('/[^a-zA-Z0-9\s]/', '', $input);

        $input = str_replace(' ', '_', $input);

        $input = strtolower($input);

        $output = $input . '(' . $this->regStart . ')';

        return $output;
    }
}
