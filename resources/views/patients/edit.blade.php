<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Patient</title>

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
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
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
            border-radius: 5px;
            cursor: pointer;
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

    <h1>Edit Patient</h1>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="/patients/{{ $patient->id }}" method="POST">

        @csrf
        @method('PUT')

        <label>Patient Name</label>
        <input
            type="text"
            name="name"
            value="{{ old('name', $patient->name) }}"
            required
        >

        <label>Email</label>
        <input
            type="email"
            name="email"
            value="{{ old('email', $patient->email) }}"
            required
        >

        <label>Phone Number</label>
        <input
            type="text"
            name="phone"
            value="{{ old('phone', $patient->phone) }}"
            required
        >

        <button type="submit">Update Patient</button>

    </form>

    <br><br>

    <a href="/patients">Back to Patient List</a>

</div>

</body>
</html>
