<!DOCTYPE html>
<html>
<head>
    <title>Add Patient</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            padding: 30px;
        }

        .container {
            background: white;
            max-width: 500px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px;
            box-sizing: border-box;
        }

        button {
            background: #1769aa;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:disabled {
            background: #888;
            cursor: not-allowed;
            opacity: 0.7;
        }

        a {
            color: #1769aa;
            text-decoration: none;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Add New Patient</h1>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="/patients" method="POST" id="patientForm">

        @csrf

        <label>Patient Name</label>
        <input type="text" name="name"
               value="{{ old('name') }}"
               placeholder="Enter patient name" required>

        <label>Email</label>
        <input type="email" name="email"
               value="{{ old('email') }}"
               placeholder="Enter email" required>

        <label>Phone Number</label>
        <input type="text" name="phone"
               value="{{ old('phone') }}"
               placeholder="Enter phone number" required>

        <button type="submit" id="submitButton">
            Save Patient
        </button>

    </form>

    <br>

    <a href="/patients">Back to Patients</a>

</div>

<script>
    const form = document.getElementById('patientForm');
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
