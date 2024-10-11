<?php
session_start();
if ($_SESSION['user'] !== 'student') {
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

// Vérification si l'utilisateur a déjà soumis une demande
$email = $_SESSION['email'];
$sql = "SELECT * FROM students WHERE email='$email' AND submitted=1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Redirige vers deja_admis.php si la demande a déjà été soumise
    header('Location: deja_admis.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle documents form submission
    $photo = $_FILES['photo'];
    $cv = $_FILES['cv'];
    $motivation_letter = $_FILES['motivation_letter'];

    // Define target directories
    $photo_target_dir = "uploads/photos/";
    $cv_target_dir = "uploads/cv/";
    $motivation_letter_target_dir = "uploads/motivation_letter/";

    // Check if directories exist, if not create them
    if (!is_dir($photo_target_dir)) {
        mkdir($photo_target_dir, 0777, true);
    }
    if (!is_dir($cv_target_dir)) {
        mkdir($cv_target_dir, 0777, true);
    }
    if (!is_dir($motivation_letter_target_dir)) {
        mkdir($motivation_letter_target_dir, 0777, true);
    }

    // Define target files
    $photo_target_file = $photo_target_dir . basename($photo["name"]);
    $cv_target_file = $cv_target_dir . basename($cv["name"]);
    $motivation_letter_target_file = $motivation_letter_target_dir . basename($motivation_letter["name"]);

    if (move_uploaded_file($photo["tmp_name"], $photo_target_file) && 
        move_uploaded_file($cv["tmp_name"], $cv_target_file) && 
        move_uploaded_file($motivation_letter["tmp_name"], $motivation_letter_target_file)) {
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
        $experience = $_POST['experience'];
        $degree = $_POST['degree'];

        $sql = "INSERT INTO students (first_name, last_name, email, phone, city, country, address, course, country_code, dob, birth_country, experience, degree, photo, cv, motivation_letter, submitted) 
                VALUES ('$first_name', '$last_name', '$email', '$phone', '$city', '$country', '$address', '$course', '$country_code', '$dob', '$birth_country', '$experience', '$degree', '$photo_target_file', '$cv_target_file', '$motivation_letter_target_file', 1)";

        if ($conn->query($sql) === TRUE) {
            header('Location: confirmation.php');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading files.";
    }
}

$conn->close();
?>
