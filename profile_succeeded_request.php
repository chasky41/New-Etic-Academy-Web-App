<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'student') {
    header('Location: index.html');
    exit();
}

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupérer les informations de l'utilisateur connecté
$email = $_SESSION['email'];
$sql = "SELECT first_name, last_name, email, course FROM students WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    $user = ['first_name' => 'Non trouvé', 'last_name' => 'Non trouvé', 'email' => 'Non trouvé', 'course' => 'Non trouvé'];
    // Debug message
    echo "Aucun utilisateur trouvé avec cet email.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Personnel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Profil Personnel</h2>
        <div class="card mt-4">
            <div class="card-body">
                <p><strong>Nom :</strong> <?php echo htmlspecialchars($user['first_name']); ?></p>
                <p><strong>Prénom :</strong> <?php echo htmlspecialchars($user['last_name']); ?></p>
                <p><strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?></p>
              
            </div>
        </div>
        <div class="alert alert-success mt-4" role="alert">
            Votre candidature a été envoyée avec succès. Veuillez ne pas dupliquer votre candidature. Une duplication entraînerait une annulation. Un conseiller vous contactera sous peu. Merci !
        </div>
        <div class="text-center mt-4">
            <!-- Bouton pour revenir à la page d'accueil -->
            <a href="http://localhost/Nouveau%20dossier_test/site/index.html" class="btn btn-secondary">Retour à l'accueil</a>
             <a href="http://localhost/Nouveau%20dossier_test/dashboard_etudiant.php" class="btn btn-secondary">Acceder a mon profile </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
