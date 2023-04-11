<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Volunteer $volunteer)
    {
        // Pass event data and status variables to the view
        return view('profile', compact(
            'volunteer'
        ));
    }
}
