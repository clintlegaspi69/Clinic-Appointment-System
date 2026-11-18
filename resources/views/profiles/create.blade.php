<!DOCTYPE html>
<html>
<head>
    <title>Add Patient Profile</title>
</head>
<body>

    <h1>Add Patient Profile</h1>

    <h3>Patient: {{ $patient->name }}</h3>

    <form action="/patients/{{ $patient->id }}/profile" method="POST">
        @csrf

        <label>Address:</label><br>
        <input type="text" name="address" value="{{ old('address') }}">
        @error('address')
            <p style="color:red">{{ $message }}</p>
        @enderror

        <br><br>

        <label>Date of Birth:</label><br>
        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
        @error('date_of_birth')
            <p style="color:red">{{ $message }}</p>
        @enderror

        <br><br>

        <label>Gender:</label><br>
        <select name="gender">
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        @error('gender')
            <p style="color:red">{{ $message }}</p>
        @enderror

        <br><br>

        <button type="submit">Save Profile</button>
    </form>

    <br>

    <a href="/patients">Back to Patient List</a>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Add Patient Profile</title>
</head>
<body>

    <h1>Add Patient Profile</h1>

    <h3>Patient: {{ $patient->name }}</h3>

    <form action="/patients/{{ $patient->id }}/profile" method="POST">
        @csrf

        <label>Address:</label><br>
        <input type="text" name="address" value="{{ old('address') }}">
        @error('address')
            <p style="color:red">{{ $message }}</p>
        @enderror

        <br><br>

        <label>Date of Birth:</label><br>
        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
        @error('date_of_birth')
            <p style="color:red">{{ $message }}</p>
        @enderror

        <br><br>

        <label>Gender:</label><br>
        <select name="gender">
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        @error('gender')
            <p style="color:red">{{ $message }}</p>
        @enderror

        <br><br>

        <button type="submit">Save Profile</button>
    </form>

    <br>

    <a href="/patients">Back to Patient List</a>

</body>
</html>
