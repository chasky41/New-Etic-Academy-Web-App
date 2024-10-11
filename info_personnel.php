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
$sql = "SELECT * FROM students WHERE email='$email'";
$result = $conn->query($sql);
$student = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Personnel & État du Dossier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            margin-bottom: 20px;
            color: #333333;
            text-align: center;
        }
        .list-group-item {
            font-size: 1.1rem;
            border: none;
            background-color: #f9f9f9;
            margin-bottom: 10px;
        }
        .list-group-item strong {
            color: #007bff;
        }
        .btn-back {
            display: block;
            margin: 20px auto;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
    


     
          <center><img src="eticphoto.png" alt="Logo"> <center> 

        <h1>Info Personnel</h1>
        <ul class="list-group">
            <li class="list-group-item">Nom: <strong><?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></strong></li>
            <li class="list-group-item">Email: <strong><?php echo htmlspecialchars($student['email']); ?></strong></li>
        </ul>

        <h2>État du Dossier</h2>
        <ul class="list-group">
            <li class="list-group-item">État: <strong><?php echo htmlspecialchars($student['dossier_status']); ?></strong></li>
        </ul>

        <a href="dashboard_etudiant.php" class="btn btn-primary btn-back">Retour au Dashboard</a>
    </div>
    <script>
        document.querySelector('.btn-back').addEventListener('mouseover', function() {
            this.style.backgroundColor = '#0056b3';
        });
        document.querySelector('.btn-back').addEventListener('mouseout', function() {
            this.style.backgroundColor = '#007bff';
        });
    </script>
</body>
</html>
