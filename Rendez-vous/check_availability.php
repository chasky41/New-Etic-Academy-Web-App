<?php
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "rendezvous";     


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$date = $_GET['date'];
$heure = $_GET['heure'];

// Prépare la requête SQL pour vérifier si la date et l'heure existent déjà
$sql = "SELECT COUNT(*) AS count FROM rendezvous WHERE date = ? AND heure = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $date, $heure);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Retourne true si la date est disponible, sinon false
$response = array("available" => $row['count'] == 0);

header('Content-Type: application/json');
echo json_encode($response);


$stmt->close();
$conn->close();
?>
