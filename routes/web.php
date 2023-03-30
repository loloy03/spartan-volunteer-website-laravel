<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Home page
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Authentication routes with email verification
Auth::routes(['verify' => true]);

// Home page (authenticated)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Show event details
Route::get('view-event/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('view-event');

// List events
Route::get('/event', [App\Http\Controllers\EventController::class, 'index'])->name('event');

// Store volunteer status
Route::post('/volunteer_status.store', [App\Http\Controllers\VolunteerStatusController::class, 'store'])->name('volunteer_status.store');

// Cancel joining
Route::post('/volunteer_status.cancelled', [App\Http\Controllers\VolunteerStatusController::class, 'cancelled'])->name('volunteer_status.cancelled');

// Confirm joining
Route::post('/volunteer_status.confirmed', [App\Http\Controllers\VolunteerStatusController::class, 'confirmed'])->name('volunteer_status.confirmed');

//Showing as joining volunteer
Route::get('join-as-volunteer/{event}', [App\Http\Controllers\JoinAsVolunteerController::class, 'show'])->name('join-as-volunteer');

Route::post('/join_as_volunteer.check_in', [App\Http\Controllers\JoinAsVolunteerController::class, 'check_in'])->name('join_as_volunteer.check_in');

Route::post('/join_as_volunteer.check_out', [App\Http\Controllers\JoinAsVolunteerController::class, 'check_out'])->name('join_as_volunteer.check_out');

Route::post('/join_as_volunteer.upload_photo', [App\Http\Controllers\JoinAsVolunteerController::class, 'upload_photo'])->name('join_as_volunteer.upload_photo');


Route::post('/store_race_type', [App\Http\Controllers\ClaimCodeController::class, 'store_race_type'])->name('claim_code.store_race');

Route::get('/claim_code/{event}', [App\Http\Controllers\ClaimCodeController::class, 'show'])->name('claim_code.show');


