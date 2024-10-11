<?php
if (isset($_SESSION['user']) && $_SESSION['user'] === 'student') {
    header('Location: login_etudiant.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style> 
        .header {
            text-align: center;
            margin-top: 20px;
        }
        .header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .btn-back {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            color: #333;
            padding: 10px 15px;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            font-size: 18px;
        }
        .btn-back:hover {
            background-color: #e2e6ea;
            color: #007bff;
        }
        .btn-custom {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            padding: 20px;
            border-radius: 10px;
        }
        .alert-icon {
            font-size: 40px;
            color: #ffc107;
        }
        .modal-body ul {
            list-style-type: disc;
            padding-left: 20px;
        }
        .modal-body li {
            margin-bottom: 10px;
        }
        .modal-body strong {
            color: #dc3545; /* Couleur d'alerte */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Login Étudiant</h1>
        <div class="header">
            <img src="eticphoto.png" alt="Profile Image">
        </div>
        <form action="process_login_etudiant.php" method="POST" class="mt-4">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
            <a href="./index.html" class="btn btn-primary">
    <i class="fas fa-arrow-left"></i> Retour
</a>

        </form>
    </div>

    <!-- Button for alert -->
    <div class="btn-custom" onclick="showAlert()">
        <i class="fas fa-info-circle"></i> Informations
    </div>

    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel"><i class="fas fa-exclamation-triangle alert-icon"></i> Important</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li><strong>Créer un compte</strong> pour accéder à votre espace étudiant personnel.</li>
                        <li><strong>Se connecter</strong> en remplissant le formulaire.</li>
                        <li><strong>Assurez-vous</strong> que toutes les informations sont correctes.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showAlert() {
            var myModal = new bootstrap.Modal(document.getElementById('infoModal'));
            myModal.show();
        }
    </script>
</body>
</html>