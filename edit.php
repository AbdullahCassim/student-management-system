<?php
include('db.php');

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM students WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Student not found.");
}

$student = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = mysqli_real_escape_string($conn, $_POST['studentName']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $class = mysqli_real_escape_string($conn, $_POST['grade']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contactNumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $update = "UPDATE students 
               SET full_name='$full_name', dob='$dob', class='$class', 
                   contact_number='$contact_number', email='$email'
               WHERE id=$id";

    if (mysqli_query($conn, $update)) {
        header("Location: index.php");
        exit();
    } else {
        echo "<div class='alert alert-danger text-center'>Error updating record: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">Edit Student Details</h2>

    <form method="POST">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="studentName" value="<?php echo htmlspecialchars($student['full_name']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="dob" value="<?php echo htmlspecialchars($student['dob']); ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Class</label>
                <input type="text" class="form-control" name="grade" value="<?php echo htmlspecialchars($student['class']); ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Contact Number</label>
                <input type="text" class="form-control" name="contactNumber" value="<?php echo htmlspecialchars($student['contact_number']); ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>
            </div>
        </div>

        <button type="submit" class="btn btn-success w-100">Update Student</button>
        <a href="index.php" class="btn btn-secondary w-100 mt-2">Cancel</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
