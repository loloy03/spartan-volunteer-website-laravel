<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class ResetStaffPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('auth.staff.passwords.reset-password');
    }


    public function reset()
    {

    }

    public function getStaffEmail()
    {
        $staff = auth()->guard('staff')->user();
        $staffEmail = $staff->email;
        return $staff;
    }
}
