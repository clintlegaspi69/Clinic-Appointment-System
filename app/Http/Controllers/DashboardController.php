<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Patients
        $totalPatients = Patient::count();

        // Total Appointments
        $totalAppointments = Appointment::count();

        // Total Services
        $totalServices = Service::count();

        // Today's Appointments
        $todayAppointments = Appointment::whereDate(
            'appointment_date',
            today()
        )->count();

        // Pending Appointments
        $pendingAppointments = Appointment::where(
            'status',
            'Pending'
        )->count();

        // Recent Appointments
        $recentAppointments = Appointment::with([
            'patient',
            'services'
        ])
        ->orderBy('appointment_date', 'desc')
        ->orderBy('appointment_time', 'desc')
        ->take(5)
        ->get();

        return view('dashboard', compact(
            'totalPatients',
            'totalAppointments',
            'totalServices',
            'todayAppointments',
            'pendingAppointments',
            'recentAppointments'
        ));
    }
}
