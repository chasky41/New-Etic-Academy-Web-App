<?php
session_start();

// Ensure user is logged in as a student
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'student') {
    header('Location: login_etudiant.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the logged-in user's email from the session
$email = $_SESSION['email'];

// Prepare and execute SQL query to count unread messages
$sql = "SELECT COUNT(*) as new_messages FROM messages WHERE recipient_email = ? AND read_status = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Output the result as JSON
header('Content-Type: application/json');
echo json_encode($data);

// Close the connection
$stmt->close();
$conn->close();
?>
