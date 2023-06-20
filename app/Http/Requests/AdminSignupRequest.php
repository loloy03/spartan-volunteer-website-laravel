<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminSignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'max:45'],
            'last_name' => ['required', 'max:45'],
            'email' => [
                'required',
                'email',
                'max:45',
                Rule::unique('admin', 'email') 
            ],
            'password' => [
                'required',
                'min:8',
                Password::min(8)
                    ->mixedCase()
                    ->numbers(),
                    // This is too much of a hassle, really ->symbols(),
                'confirmed'
            ]
        ];
    }

    public function validateSignup()
    {   
        $validatedAttributes = $this->validated();
        return $validatedAttributes;
    }
}
