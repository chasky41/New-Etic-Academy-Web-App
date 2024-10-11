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

// Check if ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer

    // Prepare statement to avoid SQL injection
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect to admin page after deletion
        header('Location: welcome_admin.php');
        exit();
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No ID provided.";
}

$conn->close();
?>
