<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];

    $stmt = $conn->prepare("INSERT INTO rendezvous (nom, prenom, email, date, heure) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nom, $prenom, $email, $date, $heure);
    $stmt->execute();
    $stmt->close();

    header("Location: confirmation.php");
    exit();
}
?>
