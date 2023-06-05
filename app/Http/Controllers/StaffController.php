<?php

namespace App\Http\Controllers;

use App\Models\Staff;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    // Show list of staff
    public function showStaffList() {
        $staffs = Staff::select('staff_id', 'first_name', 'last_name')
        ->paginate(20);

        return view('admin.partials.role-form', compact('staffs'));
    }

    public function staffListOfVolunteers()
    {
        $staffId = auth()->guard('staff')->user()->staff_id;

        return view('staff.staff-volunteers', compact('staffId'));
    }

}
