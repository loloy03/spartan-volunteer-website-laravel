<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            // event_pic: add min resolution(72ppi)
                // also, only require available file types: png, jpg, 
            // for rest, add maximum string count
            //'event_pic' => 'required',
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            // registration start
            'start_date' => 'required',
            // registration end
            'end_date' => 'required',
            'status' => 'required',
            // actual start of event
            'date' => 'required',
            // end of event
            'event_date_end' => 'required',
            // date for when claiming is valid
            'code_start_date' => 'required',
            // expiration
            'code_end_date' => 'required'
        ];
    }

    public function validateEvent() 
    {
        $validatedAttributes = $this->validated();
        return $validatedAttributes;
    }
}
