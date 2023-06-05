<?php

namespace App\Http\Controllers\Auth;

use App\Models\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StaffSignupRequest;

class StaffRegisterController extends Controller
{
    public function showRegisterForm()
    {   
        return view('auth.staff.staff-signup');
    }

    public function store(StaffSignupRequest $request)
    {
        $attributes = $request->validateSignup();

        Staff::create($attributes);

        return redirect('/staff-login');
    }

    
}
