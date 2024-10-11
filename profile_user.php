<?php
session_start();

// Vérifie si l'utilisateur est connecté
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

// Vérifier la connexion à la base de données
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupérer les informations de l'utilisateur
$email = $_SESSION['email'];
$sql = "SELECT first_name, last_name, email, phone, course, photo FROM students WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Utilisateur non trouvé.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Profil de l'utilisateur</h2>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <img src="<?php echo $user['photo']; ?>" alt="Photo de profil" class="rounded-circle" width="150" height="150">
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Nom :</strong> <?php echo $user['last_name']; ?></li>
                    <li class="list-group-item"><strong>Prénom :</strong> <?php echo $user['first_name']; ?></li>
                    <li class="list-group-item"><strong>Email :</strong> <?php echo $user['email']; ?></li>
                    <li class="list-group-item"><strong>Téléphone :</strong> <?php echo $user['phone']; ?></li>
                    <li class="list-group-item"><strong>Cours :</strong> <?php echo $user['course']; ?></li>
                </ul>
            </div>
            <div class="card-footer text-center">
                <p class="text-success">Votre candidature a été envoyée avec succès !</p>
                <p class="text-danger">
                    Veuillez ne pas dupliquer votre candidature. 
                    Une duplication de candidature peut entraîner une annulation de votre candidature. 
                    Un conseiller vous contactera dans les plus brefs délais. Merci.
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
