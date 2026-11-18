<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient Profile</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .container {
            background: white;
            max-width: 500px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px #ddd;
        }

        h1 {
            color: #176b87;
        }

        h3 {
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
        }

        input, select {
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
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #12566d;
        }

        button:disabled {
            background: #888;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .error {
            color: red;
        }

        .back-link {
            color: #176b87;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Patient Profile</h1>

    <h3>Patient: {{ $patient->name }}</h3>

    <a href="/patients" class="back-link">
        <strong>Back to Patients</strong>
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

    <form action="/patients/{{ $patient->id }}/profile"
          method="POST"
          id="profileForm">

        @csrf
        @method('PUT')

        <label>Address:</label>

        <input type="text"
               name="address"
               value="{{ old('address', $patient->profile->address ?? '') }}"
               placeholder="Enter address"
               required>

        <label>Date of Birth:</label>

        <input type="date"
               name="date_of_birth"
               value="{{ old('date_of_birth', $patient->profile->date_of_birth ?? '') }}"
               required>

        <label>Gender:</label>

        <select name="gender" required>
            <option value="">Select Gender</option>

            <option value="Male"
                {{ old('gender', $patient->profile->gender ?? '') == 'Male' ? 'selected' : '' }}>
                Male
            </option>

            <option value="Female"
                {{ old('gender', $patient->profile->gender ?? '') == 'Female' ? 'selected' : '' }}>
                Female
            </option>
        </select>

        <button type="submit" id="submitButton">
            Update Profile
        </button>

    </form>

    <br>

    <a href="/patients" class="back-link">
        Back to Patient List
    </a>

</div>

<script>
    const form = document.getElementById('profileForm');
    const button = document.getElementById('submitButton');

    form.addEventListener('submit', function (event) {

        if (button.disabled) {
            event.preventDefault();
            return;
        }

        if (!form.checkValidity()) {
            return;
        }

        button.disabled = true;
        button.textContent = 'Submitting...';
    });
</script>

</body>
</html>
