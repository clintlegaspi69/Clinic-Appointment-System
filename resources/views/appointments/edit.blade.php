<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .container {
            background: white;
            max-width: 600px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px #ddd;
        }

        h1 {
            color: #176b87;
        }

        label {
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 18px;
            box-sizing: border-box;
        }

        button {
            background: #176b87;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
        }

        .error {
            color: red;
        }

        .service-option {
            margin-bottom: 12px;
        }

        .service-option input {
            width: auto;
            margin: 0 8px 0 0;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Appointment</h1>

    <a href="/appointments"><strong>Back to Appointments</strong></a>

    <br><br>

    @if ($errors->any())
        <div class="error">
            <strong>Please check the following:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/appointments/{{ $appointment->id }}" method="POST">

        @csrf
        @method('PUT')

        <label>Select Patient:</label>

        <select name="patient_id" required>
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}"
                    {{ old('patient_id', $appointment->patient_id) == $patient->id ? 'selected' : '' }}>
                    {{ $patient->name }}
                </option>
            @endforeach
        </select>

        <label>Appointment Date:</label>

        <input
            type="date"
            name="appointment_date"
            value="{{ old('appointment_date', $appointment->appointment_date) }}"
            required
        >

        <label>Appointment Time:</label>

        <input
            type="time"
            name="appointment_time"
            value="{{ old('appointment_time', $appointment->appointment_time) }}"
            required
        >

        <label>Reason:</label>

        <textarea name="reason" rows="3" required>{{ old('reason', $appointment->reason) }}</textarea>

        <label>Status:</label>

        <select name="status" required>
            @foreach (['Pending', 'Approved', 'Completed', 'Cancelled'] as $status)
                <option value="{{ $status }}"
                    {{ old('status', $appointment->status) == $status ? 'selected' : '' }}>
                    {{ $status }}
                </option>
            @endforeach
        </select>

        <label>Select Services:</label>

        @forelse ($services as $service)

            <div class="service-option">
                <input
                    type="checkbox"
                    name="services[]"
                    value="{{ $service->id }}"
                    {{ in_array($service->id, old('services', $appointment->services->pluck('id')->toArray())) ? 'checked' : '' }}
                >

                {{ $service->service_name }}
                - ₱{{ number_format($service->price, 2) }}
            </div>

        @empty

            <p>No services available yet.</p>

        @endforelse

        <br>

        <button type="submit">Update Appointment</button>

    </form>

</div>

</body>
</html>
