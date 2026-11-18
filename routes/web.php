<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;

// Homepage
Route::get('/', function () {
    return view('welcome');
});

// Protected clinic pages
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Patient Management
    Route::get('/patients', [PatientController::class, 'index'])
        ->name('patients.index');

    Route::get('/patients/create', [PatientController::class, 'create'])
        ->name('patients.create');

    Route::post('/patients', [PatientController::class, 'store'])
        ->name('patients.store');

    Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])
        ->name('patients.edit');

    Route::put('/patients/{id}', [PatientController::class, 'update'])
        ->name('patients.update');

    Route::delete('/patients/{id}', [PatientController::class, 'destroy'])
        ->name('patients.destroy');

    // Patient Profile Management
    Route::get('/patients/{patient_id}/profile/create',
        [PatientProfileController::class, 'create']);

    Route::post('/patients/{patient_id}/profile',
        [PatientProfileController::class, 'store']);

    Route::get('/patients/{patient_id}/profile/edit',
        [PatientProfileController::class, 'edit']);

    Route::put('/patients/{patient_id}/profile',
        [PatientProfileController::class, 'update']);

    // Appointment Management
    Route::get('/appointments', [AppointmentController::class, 'index'])
        ->name('appointments.index');

    Route::get('/appointments/create', [AppointmentController::class, 'create'])
        ->name('appointments.create');

    Route::post('/appointments', [AppointmentController::class, 'store'])
        ->name('appointments.store');

    Route::get('/appointments/{id}/edit', [AppointmentController::class, 'edit'])
        ->name('appointments.edit');

    Route::put('/appointments/{id}', [AppointmentController::class, 'update'])
        ->name('appointments.update');

    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])
        ->name('appointments.destroy');

    // Breeze Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Breeze Authentication
require __DIR__.'/auth.php';
