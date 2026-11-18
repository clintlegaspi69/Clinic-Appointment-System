<!DOCTYPE html>
<html>
<head>
    <title>Add Appointment</title>

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

        h1 { color: #176b87; }

        label {
            font-weight: bold;
            display: block;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 18px;
            box-sizing: border-box;
        }

        .service-option {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 12px;
            background: #f4f6f9;
            border-radius: 6px;
        }

        .service-option input {
            width: auto;
            margin: 0 10px 0 0;
        }

        .service-option label {
            display: flex;
            justify-content: space-between;
            width: 100%;
            font-weight: normal;
        }

        button {
            background: #176b87;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover { background: #12566d; }

        button:disabled {
            background: #888;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .error { color: red; }

        .back-link {
            color: #176b87;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Add New Appointment</h1>

    <a href="/appointments" class="back-link">
        <strong>Back to Appointments</strong>
    </a>

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

    <form action="/appointments" method="POST" id="appointmentForm">
        @csrf

        <label>Select Patient:</label>

        <select name="patient_id" required>
            <option value="">Choose Patient</option>

            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}"
                    {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                    {{ $patient->name }}
                </option>
            @endforeach
        </select>

        <label>Appointment Date:</label>

        <input type="date"
               name="appointment_date"
               value="{{ old('appointment_date') }}"
               required>

        <label>Appointment Time:</label>

        <input type="time"
               name="appointment_time"
               value="{{ old('appointment_time') }}"
               required>

        <label>Reason:</label>

        <textarea name="reason" rows="3" required>{{ old('reason') }}</textarea>

        <label>Status:</label>

        <select name="status" required>
            <option value="Pending" {{ old('status', 'Pending') == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Approved" {{ old('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
            <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
            <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>

        <br><br>

        <label>Select Services:</label>

        <p>You can select multiple services.</p>

        @php
            $bloodTest = $services->firstWhere('service_name', 'Blood Test');
            $otherServices = $services->where('service_name', '!=', 'Blood Test');
        @endphp

        @if ($bloodTest)
            <div class="service-option">
                <input type="checkbox"
                       name="services[]"
                       value="{{ $bloodTest->id }}"
                       id="blood_test"
                       {{ in_array($bloodTest->id, old('services', [])) ? 'checked' : '' }}>

                <label for="blood_test">
                    <span>Blood Test</span>
                    <strong>₱{{ number_format($bloodTest->price, 2) }}</strong>
                </label>
            </div>
        @endif

        @foreach ($otherServices as $service)
            <div class="service-option">
                <input type="checkbox"
                       name="services[]"
                       value="{{ $service->id }}"
                       id="service_{{ $service->id }}"
                       {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>

                <label for="service_{{ $service->id }}">
                    <span>{{ $service->service_name }}</span>
                    <strong>₱{{ number_format($service->price, 2) }}</strong>
                </label>
            </div>
        @endforeach

        @if (!$bloodTest && $services->isEmpty())
            <p>No services available yet.</p>
        @endif

        <br>

        <button type="submit" id="submitButton">
            Save Appointment
        </button>

    </form>

</div>

<script>
    const form = document.getElementById('appointmentForm');
    const button = document.getElementById('submitButton');

    form.addEventListener('submit', function (event) {

        // Prevent another submission if already clicked
        if (button.disabled) {
            event.preventDefault();
            return;
        }

        // Allow browser validation before disabling
        if (!form.checkValidity()) {
            return;
        }

        button.disabled = true;
        button.textContent = 'Submitting...';
    });
</script>

</body>
</html>
