<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showAdminDashboard()
    {
        return view('admin.admin-dashboard');
    }

    public function showStaffDashboard()
    {
        return view('staff.staff-dashboard');
    }
}
