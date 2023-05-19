<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminSignupRequest;
use App\Http\Requests\AuthSignupRequest;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdministratorController extends Controller
{
    //
    // Render Admin-Signup Page
    public function create() {
        return view('auth.admin.admin-signup');
    }

    //
    // Create New Admin User
    public function store(AdminSignupRequest $request) {
        $attributes = $request->validateSignup();
        
        //NOTE: DEBUG
        // consider using save() instead of create()
        Administrator::create($attributes);
        //auth()->login($user);
        //dd($user);

        // add that flash thing: ->with
        return redirect('/admin-login');
    }

    //
    // Render the Admin-Login Page
    public function showLoginForm() {
        return view('auth.admin.admin-login');
    }

    //
    // Login Admin
    public function login() {
        $attributes = request()->validate([
            'email' => [
                'required',
                Rule::exists('admin', 'email')
            ],
            'password' => [
                'required'
            ]
        ]);

        if(auth()->attempt($attributes)) {
            return redirect('/home-sample');
        }
    }
}
