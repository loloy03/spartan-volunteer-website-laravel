<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RaceController extends Controller
{
    public function index() {
        $categories = config('spartanfiles.event-categories');
        return view('admin.partials.event-form', compact('categories'));
    }
}
