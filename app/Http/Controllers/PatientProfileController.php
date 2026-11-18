<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientProfileController extends Controller
{
    public function create($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);

        return view('profiles.create', compact('patient'));
    }

    public function store(Request $request, $patient_id)
    {
        $patient = Patient::findOrFail($patient_id);

        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:20',
        ]);

        $patient->profile()->updateOrCreate(
            ['patient_id' => $patient->id],
            $validated
        );

        return redirect('/patients')
            ->with('success', 'Patient profile saved successfully!');
    }

    public function edit($patient_id)
    {
        $patient = Patient::with('profile')->findOrFail($patient_id);

        return view('profiles.edit', compact('patient'));
    }

    public function update(Request $request, $patient_id)
    {
        $patient = Patient::findOrFail($patient_id);

        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:20',
        ]);

        $patient->profile()->updateOrCreate(
            ['patient_id' => $patient->id],
            $validated
        );

        return redirect('/patients')
            ->with('success', 'Patient profile updated successfully!');
    }
}
