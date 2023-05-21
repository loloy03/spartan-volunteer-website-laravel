<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminSignupRequest;
use App\Http\Requests\AuthSignupRequest;
use Illuminate\Support\Facades\Auth;
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
        
        Administrator::create($attributes);

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
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        $credentials = $request->validate([
            'email' => [
                'required',
                // Potential Security Concern: Rule::exists('staff', 'email')
            ],
            'password' => [
                'required',
            ]
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            // $request->session()->regenerate();
            
            return redirect('test-login');
        }
        else{

            return redirect('fail-login');
        }

    }
}
