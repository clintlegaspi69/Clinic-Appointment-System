<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f9;
            color: #333;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            height: 100vh;
            background: #176b87;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 25px 15px;
        }

        .sidebar h2 {
            text-align: center;
            font-size: 21px;
            margin-bottom: 35px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 14px 15px;
            margin-bottom: 8px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #12566d;
        }

        .logout-form {
            margin-top: 30px;
        }

        .logout-button {
            width: 100%;
            border: none;
            background: transparent;
            color: white;
            text-align: left;
            padding: 14px 15px;
            cursor: pointer;
            font-size: 15px;
            border-radius: 6px;
        }

        .logout-button:hover {
            background: #12566d;
        }

        /* Main Content */
        .main-content {
            margin-left: 220px;
            padding: 30px;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 27px;
            color: #263746;
            margin-bottom: 8px;
        }

        .header p {
            color: #777;
        }

        /* Statistics */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 22px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .stat-card h3 {
            font-size: 14px;
            color: #777;
            margin-bottom: 15px;
            font-weight: normal;
        }

        .stat-card p {
            font-size: 29px;
            font-weight: bold;
            color: #176b87;
        }

        /* Quick Actions */
        .section-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            margin-bottom: 25px;
        }

        .section-card h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #263746;
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .action-buttons a {
            display: inline-block;
            padding: 12px 18px;
            background: #176b87;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
        }

        .action-buttons a:hover {
            background: #12566d;
        }

        /* Recent Appointments Table */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        thead {
            background: #176b87;
            color: white;
        }

        th, td {
            padding: 14px;
            text-align: left;
            font-size: 14px;
        }

        tbody tr {
            border-bottom: 1px solid #eee;
        }

        tbody tr:hover {
            background: #f8fafb;
        }

        .status {
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            display: inline-block;
        }

        .pending {
            background: #fff3cd;
            color: #856404;
        }

        .completed {
            background: #d4edda;
            color: #155724;
        }

        .other-status {
            background: #e2e3e5;
            color: #383d41;
        }

        .empty-message {
            text-align: center;
            padding: 25px;
            color: #888;
        }

        .footer {
            text-align: center;
            color: #888;
            font-size: 13px;
            margin-top: 30px;
        }

        /* Responsive */
        @media (max-width: 1100px) {
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .sidebar h2 {
                margin-bottom: 15px;
            }

            .sidebar a {
                margin-bottom: 4px;
            }

            .logout-form {
                margin-top: 5px;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">

        <h2>CLINIC SYSTEM</h2>

        <a href="{{ url('/dashboard') }}" class="active">
            Dashboard
        </a>

        <a href="{{ url('/patients') }}">
            Patients
        </a>

        <a href="{{ url('/appointments') }}">
            Appointments
        </a>

        <a href="{{ url('/appointments') }}">
            Services
        </a>

        <form method="POST" action="{{ route('logout') }}"
              class="logout-form">
            @csrf

            <button type="submit" class="logout-button">
                Logout
            </button>
        </form>

    </div>

    <!-- Main Content -->
    <div class="main-content">

        <div class="header">
            <h1>Clinic Appointment Dashboard</h1>
            <p>Welcome! Manage your clinic operations here.</p>
            <p style="margin-top: 8px;">
                {{ now()->format('F d, Y') }}
            </p>
        </div>

        <!-- Statistics -->
        <div class="stats-container">

            <div class="stat-card">
                <h3>Total Patients</h3>
                <p>{{ $totalPatients }}</p>
            </div>

            <div class="stat-card">
                <h3>Total Appointments</h3>
                <p>{{ $totalAppointments }}</p>
            </div>

            <div class="stat-card">
                <h3>Total Services</h3>
                <p>{{ $totalServices }}</p>
            </div>

            <div class="stat-card">
                <h3>Today's Appointments</h3>
                <p>{{ $todayAppointments }}</p>
            </div>

            <div class="stat-card">
                <h3>Pending Appointments</h3>
                <p>{{ $pendingAppointments }}</p>
            </div>

        </div>

        <!-- Quick Actions -->
        <div class="section-card">

            <h2>Quick Actions</h2>

            <div class="action-buttons">

                <a href="{{ url('/patients/create') }}">
                    + Add Patient
                </a>

                <a href="{{ url('/patients') }}">
                    View Patients
                </a>

                <a href="{{ url('/appointments/create') }}">
                    + Add Appointment
                </a>

                <a href="{{ url('/appointments') }}">
                    View Appointments
                </a>

            </div>

        </div>

        <!-- Recent Appointments -->
        <div class="section-card">

            <h2>Recent Appointments</h2>

            <div class="table-container">

                <table>

                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Reason</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($recentAppointments as $appointment)

                            <tr>

                                <td>
                                    {{ $appointment->patient->name ?? 'No patient' }}
                                </td>

                                <td>
                                    {{ $appointment->appointment_date }}
                                </td>

                                <td>
                                    {{ $appointment->appointment_time }}
                                </td>

                                <td>
                                    {{ $appointment->reason }}
                                </td>

                                <td>
                                    @if ($appointment->status == 'Pending')
                                        <span class="status pending">
                                            Pending
                                        </span>
                                    @elseif ($appointment->status == 'Completed')
                                        <span class="status completed">
                                            Completed
                                        </span>
                                    @else
                                        <span class="status other-status">
                                            {{ $appointment->status }}
                                        </span>
                                    @endif
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="empty-message">
                                    No appointments available.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="footer">
            Clinic Appointment Management System
        </div>

    </div>

</body>
</html>
