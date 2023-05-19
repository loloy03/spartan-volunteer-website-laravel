<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthSignupRequest;
use App\Http\Requests\StaffSignupRequest;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    // Show list of staff
    public function showStaffList() {
        $staffs = Staff::select('staff_id', 'first_name', 'last_name')
        ->paginate(20);

        return view('admin.partials.role-form', compact('staffs'));
    }

    // Render Staff-Signup Page
    public function create() {
        return view('auth.staff.staff-signup');
    }

    // Create New Staff User
    public function store(StaffSignupRequest $request) {
        $attributes = $request->validateSignup();

        Staff::create($attributes);

        //NOTE: DEBUG
        //$user = Staff::create($attributes);
        //auth()->login($user);
        //dd($user);

        // add that flash thing: ->with
        return redirect('/staff-login');
    }

    // Render the Staff-Login Page
    public function showLoginForm() {
        return view('auth.staff.staff-login');
    }

    // Login Staff
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

        if (Auth::guard('staff')->attempt($credentials)) {
            // $request->session()->regenerate();
            
            return redirect('test-login');
        }
        else{

            return redirect('fail-login');
        }

    }
}
