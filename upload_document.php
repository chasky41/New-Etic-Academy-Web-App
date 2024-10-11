<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login_etudiant.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["document"]["name"]);

if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
    $sql = "INSERT INTO documents_etudiants (email, file_path) VALUES ('$email', '$target_file')";
    if ($conn->query($sql) === TRUE) {
        header('Location: espace_etudiant.php');
        exit();
    } else {
        echo "Erreur : " . $conn->error;
    }
} else {
    echo "Erreur lors du téléchargement du fichier.";
}

$conn->close();
?>
