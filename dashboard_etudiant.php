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
$sql = "SELECT first_name, last_name FROM students WHERE email='$email'";
$result = $conn->query($sql);
$student = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f9fc; /* Soft blue background */
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 800px;
            margin-top: 70px;
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .logo {
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            background-color: #007bff; /* Blue background for the logo */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .logo img {
            width: 100%;
            height: auto;
        }
        h1 {
            margin-bottom: 30px;
            color: #333333;
            text-align: center;
        }
        .nav-tabs {
            margin-bottom: 30px;
        }
        .nav-link {
            font-size: 1.1rem;
            color: #007bff;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .nav-link.active {
            color: #ffffff;
            background-color: #007bff;
            border-radius: 0.25rem;
        }
        .nav-link:hover {
            background-color: #0056b3;
            color: #ffffff;
        }
        .content {
            text-align: center;
            margin-top: 30px;
        }
        .btn-back {
            margin-top: 30px;
            display: inline-flex;
            align-items: center;
        }
        .btn-back i {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="eticphoto.png" alt="Logo"> <!-- Replace with your logo file -->
        </div>
        <br>
        <h1>Bienvenue, <?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></h1>
        <ul class="nav nav-tabs justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="messagerie.php">Messagerie</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="info_personnel.php">Info Personnel & État du Dossier</a>
            </li>
        </ul>
        <div class="content">
            <p>Sélectionnez une option dans le menu pour commencer.</p>
        </div>
        <a href="site/index.html" class="btn btn-primary btn-back">
            <i class="fas fa-arrow-left"></i> Retour à la page d'accueil
        </a>
    </div>
</body>
</html>
