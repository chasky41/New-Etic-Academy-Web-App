<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update student details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $course = $_POST['course'];
    $country_code = $_POST['country_code'];
    $dob = $_POST['dob'];
    $birth_country = $_POST['birth_country'];
    $degree = $_POST['degree'];

    $sql = "UPDATE students SET first_name=?, last_name=?, email=?, phone=?, city=?, country=?, address=?, course=?, country_code=?, dob=?, birth_country=?, degree=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssi", $first_name, $last_name, $email, $phone, $city, $country, $address, $course, $country_code, $dob, $birth_country, $degree, $id);

    if ($stmt->execute()) {
        header('Location: welcome_admin.php');
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
