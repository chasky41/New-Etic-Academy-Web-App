<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'student') {
    header('Location: login_etudiant.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];
$subject = $_POST['subject'];
$body = $_POST['body'];
$pdf_file = isset($_FILES['pdf_file']) ? $_FILES['pdf_file']['name'] : '';

if ($pdf_file) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($pdf_file);
    move_uploaded_file($_FILES['pdf_file']['tmp_name'], $target_file);
}

$sql = "INSERT INTO messages (recipient_email, subject, body, pdf_file) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $email, $subject, $body, $pdf_file);

if ($stmt->execute()) {
    header('Location: messagerie.php?status=success');
} else {
    echo "Erreur: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
