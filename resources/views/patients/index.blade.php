<!DOCTYPE html>
<html>
<head>
    <title>Clinic Appointment System</title>
</head>
<body>

    <h1>Clinic Appointment System</h1>

    <a href="/patients/create">
        <button type="button">Add New Patient</button>
    </a>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    @if (session('error'))
        <p style="color: red;">
            {{ session('error') }}
        </p>
    @endif

    @foreach ($patients as $patient)

        <h2>Patient Information</h2>

        <p>Name: {{ $patient->name }}</p>
        <p>Email: {{ $patient->email }}</p>
        <p>Phone: {{ $patient->phone }}</p>

        <!-- Edit Patient Button -->
        <a href="/patients/{{ $patient->id }}/edit">
            <button type="button">Edit Patient</button>
        </a>

        <!-- Delete Patient Button -->
        <form action="/patients/{{ $patient->id }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this patient?');">

            @csrf
            @method('DELETE')

            <button type="submit">Delete Patient</button>
        </form>

        <h3>Patient Profile</h3>

        @if ($patient->profile)
            <p>Address: {{ $patient->profile->address }}</p>
            <p>Gender: {{ $patient->profile->gender }}</p>
        @else
            <p>No profile available.</p>
        @endif

        <h3>Appointments</h3>

        @forelse ($patient->appointments as $appointment)

            <p>Date: {{ $appointment->appointment_date }}</p>
            <p>Time: {{ $appointment->appointment_time }}</p>
            <p>Status: {{ $appointment->status }}</p>
            <p>Reason: {{ $appointment->reason }}</p>

            <h4>Services</h4>

            @forelse ($appointment->services as $service)
                <p>
                    {{ $service->service_name }}
                    - ₱{{ number_format($service->price, 2) }}
                </p>
            @empty
                <p>No services assigned.</p>
            @endforelse

        @empty
            <p>No appointments available.</p>
        @endforelse

        <hr>

    @endforeach

</body>
</html>
