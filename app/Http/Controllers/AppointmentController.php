<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Display all appointments
    public function index()
    {
        $appointments = Appointment::with(['patient', 'services'])
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    // Show Add Appointment Form
    public function create()
    {
        $patients = Patient::all();
        $services = Service::all();

        return view('appointments.create', compact('patients', 'services'));
    }

    // Save Appointment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status' => 'required|string|max:50',
            'reason' => 'required|string|max:255',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
        ]);

        $appointment = Appointment::create([
            'patient_id' => $validated['patient_id'],
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'status' => $validated['status'],
            'reason' => $validated['reason'],
        ]);

        $appointment->services()->sync($validated['services'] ?? []);

        return redirect('/appointments')
            ->with('success', 'Appointment added successfully!');
    }

    // Show Edit Appointment Form
    public function edit($id)
    {
        $appointment = Appointment::with('services')->findOrFail($id);

        $patients = Patient::all();
        $services = Service::all();

        return view('appointments.edit', compact(
            'appointment',
            'patients',
            'services'
        ));
    }

    // Update Appointment
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status' => 'required|string|max:50',
            'reason' => 'required|string|max:255',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
        ]);

        $appointment->update([
            'patient_id' => $validated['patient_id'],
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'status' => $validated['status'],
            'reason' => $validated['reason'],
        ]);

        $appointment->services()->sync($validated['services'] ?? []);

        return redirect('/appointments')
            ->with('success', 'Appointment updated successfully!');
    }

    // Delete Appointment
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->services()->detach();
        $appointment->delete();

        return redirect('/appointments')
            ->with('success', 'Appointment deleted successfully!');
    }
}
