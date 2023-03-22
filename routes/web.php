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

