<?php

namespace App\Http\Controllers;

use App\Exports\AdminVolunteersExport;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportsController extends Controller
{
    public function exportAdminVolunteers()
    {
        return Excel::download(new AdminVolunteersExport, 'volunteers.xlsx');
    }
}
