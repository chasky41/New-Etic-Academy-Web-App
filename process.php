<?php
session_start();

// Inclure le fichier de configuration
include 'config.php';

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

// Traitement des requêtes POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Vérifier si l'utilisateur est un administrateur
        if ($email === ADMIN_EMAIL && $password === ADMIN_PASSWORD) {
            $_SESSION['user'] = 'admin';
            header('Location: welcome_admin.php');
            exit();
        }

        // Vérifier si l'utilisateur est un étudiant
        $sql = "SELECT * FROM students WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Vérifier le mot de passe haché
            if (password_verify($password, $user['password'])) {
                if ($user['submitted'] == 1) {
                    header('Location: deja_admis.php');
                    exit();
                } else {
                    $_SESSION['user'] = 'student';
                    $_SESSION['email'] = $email;
                    header('Location: welcome_student.php');
                    exit();
                }
            } else {
                echo "<script>alert('Mot de passe incorrect.'); window.location.href='index.html';</script>";
            }
        } else {
            echo "<script>alert('Email ou mot de passe incorrect.'); window.location.href='index.html';</script>";
        }
    }

    if (isset($_POST['sign_up'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO students (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $first_name, $last_name, $email, $password);

        if ($stmt->execute()) {
            echo "<script>alert('Inscription réussie ! Veuillez vous connecter.'); window.location.href='index.html';</script>";
        } else {
            echo "Erreur: " . $stmt->error;
        }
    }
}

$conn->close();
?>
