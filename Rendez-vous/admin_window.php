<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Détails d'authentification (à remplacer par une vérification en base de données dans un cas réel)
        $adminEmail = 'adminesicmeet41@gmail.com';
        $adminPassword = 'hackme123'; // À utiliser uniquement comme exemple ! Utilisez des mots de passe sécurisés.

        if ($email === $adminEmail && $password === $adminPassword) {
            $_SESSION['admin_logged_in'] = true;
            header('Location: admin_meet_panel.php');
            exit();
        } else {
            $error = 'Email ou mot de passe incorrect.';
        }
    } elseif (isset($_POST['confirmation_code'])) {
        // Code de confirmation pour déconnexion
        $confirmationCode = $_POST['confirmation_code'];
        if ($confirmationCode === '0000') {
            session_unset();
            session_destroy();
            header('Location: http://localhost/Nouveau%20dossier_test/index.html');
            exit();
        } else {
            $error = 'Code de confirmation incorrect.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5 text-center">
        <img src="../eticphoto.png" alt="Admin Photo" class="profile-photo">
        <h1>Connexion Administrateur</h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert"><?= $error ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
        <button class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#logoutModal">Déconnexion</button>
    </div>

    <!-- Modal pour le code de confirmation -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirmation de Déconnexion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="logoutForm" action="" method="POST">
                        <div class="mb-3">
                            <label for="confirmationCode" class="form-label">Entrez le code de confirmation</label>
                            <input type="text" class="form-control" id="confirmationCode" name="confirmation_code" required>
                        </div>
                        <?php if ($error): ?>
                            <div class="alert alert-danger" role="alert"><?= $error ?></div>
                        <?php endif; ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="submitLogout()">Confirmer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
    <script>
        function submitLogout() {
            var code = document.getElementById('confirmationCode').value;
            // Vérification du code
            if (code === '0000') { // Code de confirmation
                document.getElementById('logoutForm').submit();
            } else {
                alert('Code de confirmation incorrect.');
            }
        }
    </script>
</body>
</html>
