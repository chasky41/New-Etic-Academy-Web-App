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

// Fetch student data
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $delimiter = ",";
    $filename = "students_" . date('Y-m-d') . ".csv";

    // Create a file pointer
    $f = fopen('php://memory', 'w');

    // Set column headers
    $fields = array('ID', 'First Name', 'Last Name', 'Email', 'Phone', 'City', 'Country', 'Address', 'Course', 'Country Code', 'Date of Birth', 'Country of Birth', 'Degree', 'CV', 'Motivation Letter');
    fputcsv($f, $fields, $delimiter);

    // Output each row of the data
    while ($row = $result->fetch_assoc()) {
        $lineData = array($row['id'], $row['first_name'], $row['last_name'], $row['email'], $row['phone'], $row['city'], $row['country'], $row['address'], $row['course'], $row['country_code'], $row['dob'], $row['birth_country'], $row['degree'], $row['cv'], $row['motivation_letter']);
        fputcsv($f, $lineData, $delimiter);
    }

    // Move back to beginning of file
    fseek($f, 0);

    // Set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    // Output all remaining data on a file pointer
    fpassthru($f);
}
exit();
?>
