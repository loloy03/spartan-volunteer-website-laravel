<?php

namespace App\Http\Controllers\Auth\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.super_admin.login');
    }

    public function login(Request $request)
    {
        $userName = $request->email;
        $password = $request->password;

        $attributes = request()->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if($userName == 'admin' && $password == 'admin')
        {
            if(auth()->guard('admin')->attempt(['email' => $userName, 'password' => $password]))
            {
                dd(auth());
                return redirect('all-volunteers');
            }
        }
    }
}
