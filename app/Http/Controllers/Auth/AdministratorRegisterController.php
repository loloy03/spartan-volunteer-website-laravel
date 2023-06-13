<?php

namespace App\Http\Controllers\Auth;

use App\Models\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\AdminSignupRequest;

class AdministratorRegisterController extends Controller
{
    public function showRegisterForm()
    {   
        return view('auth.admin.admin-signup');
    }

    public function store(AdminSignupRequest $request)
    {
        $attributes = $request->validateSignup();

        Administrator::create($attributes);

        return redirect('/admin-login');
    }
}
