<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des valeurs du formulaire
$email = $_POST['email'];
$password = $_POST['password'];

// Recherche de l'utilisateur par email
$sql = "SELECT * FROM students WHERE email='$email'";
$result = $conn->query($sql);

$message = ''; // Variable pour stocker le message d'erreur ou de succès

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Vérification du mot de passe
    if (password_verify($password, $row['password'])) {
        $_SESSION['user'] = 'student';
        $_SESSION['email'] = $row['email'];
        header('Location: dashboard_etudiant.php');
        exit();
    } else {
        $message = '<div class="alert alert-danger" role="alert">Mot de passe incorrect.</div>';
    }
} else {
    $message = '<div class="alert alert-danger" role="alert">Email non trouvé.</div>';
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Connexion Étudiant</h2>

        <?php
        if (!empty($message)) {
            // Afficher le message d'erreur
            echo $message;
        }
        ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
    </div>
</body>
</html>
