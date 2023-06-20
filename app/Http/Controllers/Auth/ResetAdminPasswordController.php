<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetAdminPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('auth.admin.passwords.reset-password');
    }

    public function reset()
    {

    }
}
