<!DOCTYPE html>
<html>
<head>
    <title>Appointment Management</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        h1 {
            color: #176b87;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #176b87;
            color: white;
        }

        button {
            padding: 8px 12px;
            cursor: pointer;
        }

        .add-button {
            background: #176b87;
            color: white;
            border: none;
            padding: 10px 15px;
            text-decoration: none;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>

    <h1>Appointment Management</h1>

    <a href="/dashboard"><strong>Back to Dashboard</strong></a>

    <br><br>

    <a href="/appointments/create" class="add-button">
        Add New Appointment
    </a>

    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Patient</th>
                <th>Date</th>
                <th>Time</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Services</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->patient->name ?? 'Unknown' }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->appointment_time }}</td>
                    <td>{{ $appointment->reason }}</td>
                    <td>{{ $appointment->status }}</td>

                    <td>
                        @forelse ($appointment->services as $service)
                            {{ $service->service_name }}<br>
                        @empty
                            No services
                        @endforelse
                    </td>

                    <td>
                        <a href="/appointments/{{ $appointment->id }}/edit">
                            Edit
                        </a>

                        <form action="/appointments/{{ $appointment->id }}"
                              method="POST"
                              onsubmit="return confirm('Delete this appointment?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No appointments available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
