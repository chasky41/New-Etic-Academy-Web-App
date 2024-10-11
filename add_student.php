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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $city = $conn->real_escape_string($_POST['city']);
    $country = $conn->real_escape_string($_POST['country']);
    $address = $conn->real_escape_string($_POST['address']);
    $course = $conn->real_escape_string($_POST['course']);
    $country_code = $conn->real_escape_string($_POST['country_code']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $birth_country = $conn->real_escape_string($_POST['birth_country']);
    $degree = $conn->real_escape_string($_POST['degree']);

    $sql = "INSERT INTO students (first_name, last_name, email, phone, city, country, address, course, country_code, dob, birth_country, degree) 
            VALUES ('$first_name', '$last_name', '$email', '$phone', '$city', '$country', '$address', '$course', '$country_code', '$dob', '$birth_country', '$degree')";

    if ($conn->query($sql) === TRUE) {
        header('Location: welcome_admin.php');
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
