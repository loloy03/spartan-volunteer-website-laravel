<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\Auth\StaffLoginController;
use App\Http\Controllers\Auth\AdministratorLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffStatusController;
use App\Http\Controllers\VolunteerStatusController;
use App\Http\Controllers\Auth\SuperAdmin\SuperAdminLoginController;
use App\Models\Volunteer;

// Home page
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Authentication routes with email verification
Auth::routes(['verify' => true]);

// Home page (authenticated)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// List events
// NOTE: KEEP THIS PUBLIC
// Applying middleware staff and admin somehow doesn't work
// NO ALTERNATIVE WORKING SOLUTION
Route::get('/event', [App\Http\Controllers\EventController::class, 'index'])->name('event');

Route::group(['middleware' => ['auth']], function () {
    // Route for verified volunteer
    Route::middleware(['verified'])->group(function () {
        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');

        Route::get('/history', [App\Http\Controllers\HistoryController::class, 'show'])->name('history.show');

        Route::get('/volunteer_info_edit', [App\Http\Controllers\ProfileController::class, 'volunteer_info_edit'])->name('volunteer_info_edit');

        Route::post('/volunteer_info_update', [App\Http\Controllers\ProfileController::class, 'volunteer_info_update'])->name('volunteer_info.update');


        Route::get('/address_edit', [App\Http\Controllers\ProfileController::class, 'address_edit'])->name('address_edit');

        Route::post('/address_update', [App\Http\Controllers\ProfileController::class, 'address_update'])->name('address_update');

        Route::get('/contact_edit', [App\Http\Controllers\ProfileController::class, 'contact_edit'])->name('contact_edit');

        Route::post('/contact_update', [App\Http\Controllers\ProfileController::class, 'contact_update'])->name('contact_update');


        // Store volunteer status
        Route::post('/volunteer_status_store', [App\Http\Controllers\VolunteerStatusController::class, 'store'])->name('volunteer_status.store');

        // Cancel joining
        Route::post('/volunteer_status_cancelled', [App\Http\Controllers\VolunteerStatusController::class, 'cancelled'])->name('volunteer_status.cancelled');

        // Confirm joining
        Route::post('/volunteer_status_confirmed', [App\Http\Controllers\VolunteerStatusController::class, 'confirmed'])->name('volunteer_status.confirmed');

        //Showing as joining volunteer
        Route::get('join-as-volunteer/{event}', [App\Http\Controllers\JoinAsVolunteerController::class, 'show'])->name('join-as-volunteer');

        Route::post('/join_as_volunteer_check_in', [App\Http\Controllers\JoinAsVolunteerController::class, 'check_in'])->name('join_as_volunteer.check_in');

        Route::post('/join_as_volunteer_check_out', [App\Http\Controllers\JoinAsVolunteerController::class, 'check_out'])->name('join_as_volunteer.check_out');

        Route::post('/join_as_volunteer_upload_photo', [App\Http\Controllers\JoinAsVolunteerController::class, 'upload_photo'])->name('join_as_volunteer.upload_photo');

        Route::post('/store_race_type', [App\Http\Controllers\ClaimCodeController::class, 'store_race_type'])->name('claim_code.store_race');

        Route::get('/claim_code/{event}', [App\Http\Controllers\ClaimCodeController::class, 'show'])->name('claim_code.show');

        Route::post('/claim_code.upload_receipt', [App\Http\Controllers\ClaimCodeController::class, 'upload_receipt'])->name('claim_code.upload_receipt');

        Route::post('/claim_code.confirm', [App\Http\Controllers\ClaimCodeController::class, 'confirm'])->name('claim_code.confirm');

        Route::post('/claim_code.cancel', [App\Http\Controllers\ClaimCodeController::class, 'cancel'])->name('claim_code.cancel');

        // Show event details
        Route::get('view-event/{event}', [EventController::class, 'show'])->name('view-event');
    });
});

// ADMIN ROUTES
// Middleware: admin
// IMPORTANT: It seems using Administrator instead of Admin is preferable
Route::group(['middleware' => ['admin']], function () {
    //
    Route::get('/admin-dashboard', [DashboardController::class, 'showAdminDashboard']);
});

// Admin Signup
// Route::get('/admin-signup', [AdministratorController::class, 'create'])->middleware('guest');
// Route::post('/admin-signup', [AdministratorController::class, 'store'])->middleware('guest');

// Admin Login
Route::get('/admin-login', [AdministratorLoginController::class, 'showLoginForm']);
Route::post('/admin-login', [AdministratorLoginController::class, 'login']);

Route::post('/admin-logout', [AdministratorLoginController::class, 'logout']);

// Create Event
Route::get('/create-event', [EventController::class, 'create'])->name('create-event');
Route::post('/create-event', [EventController::class, 'store'])->name('create-event.post');

Route::get('/admin-volunteers', [VolunteerController::class, 'adminListOfVolunteers'])->name('admin-volunteers');

Route::get('/{event}/verify-claim', [EventController::class, 'listOfVolunteerRace'])->name('claim.verify');

Route::get('/{event}/event-volunteers', [EventController::class, 'listOfEventVolunteers'])->name('event.volunteers');

Route::get('/{event}/event-staffs', [EventController::class, 'listOfEventStaffs'])->name('event.staffs');

Route::get('/test-login', function () {
    return view('test-login');
});

// STAFF ROUTES
// Middleware: staff
Route::group(['middleware' => ['staff']], function () {
    //

    Route::get('/staff-dashboard', [DashboardController::class, 'showStaffDashboard']);
});

// Staff Signup
// Route::get('/staff-signup', [StaffController::class, 'create'])->middleware('guest');
// Route::post('/staff-signup', [StaffController::class, 'store'])->middleware('guest');

// Staff Login
Route::get('/staff-login', [StaffLoginController::class, 'showLoginForm'])->middleware('guest');
Route::post('/staff-login', [StaffLoginController::class, 'login']);

Route::post('/staff-logout', [StaffLoginController::class, 'logout']);

// Staff-Give Volunteer Role
// input staff_id, event_id, and staff_role/staff_status
Route::get('/{event}/add-volunteer', [EventController::class, 'listOfConfirmedVolunteers'])->name('add-volunteer');
Route::post('/{event}/add-volunteer', [VolunteerStatusController::class, 'updateConfirmedVolunteers'])->name('add-volunteer.post');

// Staff-Validate Volunteer Attendance
// input staff_id, event_id, and staff_role/staff_status
Route::get('/{event}/check-attendance', [EventController::class, 'listOfPendingVolunteers'])->name('check-attendance');
Route::post('/{event}/check-attendance', [VolunteerStatusController::class, 'updatePendingVolunteers'])->name('check-attendance.post');

Route::get('/staff-volunteers', [StaffController::class, 'staffListOfVolunteers'])->name('staff-volunteers');

// shared by staff and admin
Route::get('admin-staff-view-event/{event}', [EventController::class, 'show'])->name('admin-staff-view-event');

Route::get('/super-admin-login', [SuperAdminLoginController::class, 'showLoginForm']);
Route::post('/super-admin-login', [SuperAdminLoginController::class, 'login']);

Route::get('/all-volunteers', [VolunteerController::class, 'allVolunteers']);


