<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with([
            'profile',
            'appointments.services'
        ])->get();

        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'phone' => 'required|string|max:20',
        ]);

        Patient::create($validated);

        return redirect('/patients')
            ->with('success', 'Patient added successfully!');
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);

        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('patients', 'email')->ignore($patient->id),
            ],
            'phone' => 'required|string|max:20',
        ]);

        $patient->name = $validated['name'];
        $patient->email = $validated['email'];
        $patient->phone = $validated['phone'];

        $patient->save();

        return redirect('/patients')
            ->with('success', 'Patient updated successfully!');
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);

        if ($patient->profile()->exists() || $patient->appointments()->exists()) {
            return redirect('/patients')
                ->with('error', 'Cannot delete patient with existing profile or appointments.');
        }

        $patient->delete();

        return redirect('/patients')
            ->with('success', 'Patient deleted successfully!');
    }
}
