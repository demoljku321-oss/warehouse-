
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
</head>
<body>

    <h2>Student Registration Form</h2>

    @if(session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <label>Student Name:</label>
        <input type="text" name="student_name"
               value="{{ old('student_name') }}" required>
        <br><br>

        <label>Roll Number:</label>
        <input type="text" name="roll_number"
               value="{{ old('roll_number') }}" required>
        <br><br>

        <label>Email:</label>
        <input type="email" name="email"
               value="{{ old('email') }}" required>
        <br><br>

        <label>Phone:</label>
        <input type="text" name="phone"
               value="{{ old('phone') }}">
        <br><br>

        <label>Gender:</label>
        <select name="gender">
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        <br><br>

        <label>Date of Birth:</label>
        <input type="date" name="date_of_birth">
        <br><br>

        <label>Course:</label>
        <input type="text" name="course"
               value="{{ old('course') }}" required>
        <br><br>

        <label>Semester:</label>
        <input type="number" name="semester"
               min="1" value="{{ old('semester') }}" required>
        <br><br>

        <button type="submit">Save Student</button>
    </form>

</body>
</html>
