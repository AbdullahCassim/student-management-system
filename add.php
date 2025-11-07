<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = mysqli_real_escape_string($conn, $_POST['studentName']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $class = mysqli_real_escape_string($conn, $_POST['grade']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contactNumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "INSERT INTO students (full_name, dob, class, contact_number, email)
            VALUES ('$full_name', '$dob', '$class', '$contact_number', '$email')";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success text-center'>Student registered successfully!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">Student Registration Form</h2>

    <form method="post">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="studentName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="studentName" name="studentName" placeholder="Enter full name" required>
            </div>
            <div class="col-md-6">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="grade" class="form-label">Grade/Class</label>
                <select id="grade" name="grade" class="form-select" required>
                    <option value="" selected disabled>Select grade</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="contactNumber" class="form-label">Contact Number</label>
                <input type="tel" class="form-control" id="contactNumber" placeholder="Enter phone number" name="contactNumber" required>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Register Student</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
