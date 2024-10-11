<?php
include('db_connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer le rendez-vous
    $stmt = $conn->prepare("DELETE FROM rendezvous WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: admin_meet_panel.php");
    exit();
}
?>
