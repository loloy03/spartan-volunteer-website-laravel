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
    public $date, $regStart, $regEnd, $claimStart, $claimEnd;
    public $races = [];
    public $roles = [];

    public function render()
    {
        $staffs = $this->getStaffs();
        return view('livewire.admin.create-event-form', compact('staffs'));
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
        // $this->validate();

        $title = ucwords($this->title);
        $description = $this->formatParagraph($this->description);
        $location = ucwords($this->location);

        $filePath = 'images/event_thumbnails';
        $fileType = '.' . $this->image->getClientOriginalExtension();
        $fileName = 'thumbnail_' . $title . '-' . $this->date . $fileType;

        $this->image->storeAs($filePath, $fileName, 'public');

        Events::create([
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

        // insert Event Race


        // insert Event Staffs

        return redirect('/event');
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
