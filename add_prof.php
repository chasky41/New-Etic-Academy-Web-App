<?php
session_start();
if ($_SESSION['user'] !== 'admin') {
    header('Location: index.html');
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add new professor
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $department = $conn->real_escape_string($_POST['department']);

    $photo = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $photo = 'uploads/' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
    }

    $conn->query("INSERT INTO professors (first_name, last_name, email, phone, department, photo) VALUES ('$first_name', '$last_name', '$email', '$phone', '$department', '$photo')");

    header('Location: gestion_prof.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Professor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .container {
            margin-top: 50px;
        }
        .form-control {
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }
        .btn-icon {
            font-size: 1.2rem;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .header {
            text-align: center;
            margin-top: 20px;
        }
        .header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .modal-content {
            background-color: #000; /* Black background */
            color: #fff; /* White text */
        }
        .modal-header, .modal-body, .modal-footer {
            border-color: #333; /* Darker border for the modal */
        }
        .modal-header .btn-close {
            filter: invert(1); /* Make close button white */
        }
    </style>
</head>
<body>


<div class="header">
        <img src="eticphoto.png" alt="Profile Image">
    </div>


    <div class="container">
        <h1 class="text-center mb-4">Add Professor</h1>
        <form action="add_prof.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="first_name" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="last_name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" name="department" required>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
            </div>
            <div class="d-flex justify-content-between">
                <a href="gestion_prof.php" class="btn btn-secondary btn-icon"><i class="fas fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-primary btn-icon">Save Professor</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
