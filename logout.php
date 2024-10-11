<?php
session_start();

// Vérifier si l'utilisateur est administrateur
if ($_SESSION['user'] !== 'admin') {
    header('Location: index.html');
    exit();
}

// Initialiser un message d'erreur
$error_message = '';

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_code = $_POST['code'];

    // Code de confirmation (à remplacer par un code plus sécurisé si nécessaire)
    $confirmation_code = '0000';

    if ($entered_code === $confirmation_code) {
        // Détruire la session et rediriger vers la page de connexion
        session_unset();
        session_destroy();
        header('Location: index.html');
        exit();
    } else {
        $error_message = "Code de confirmation incorrect.";
    }
}
?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>



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
        .modal-content {
            background-color: #000; /* Black background */
            color: #fff; /* White text */
        }
        .modal-header, .modal-body, .modal-footer {
            border-color: #333; /* Darker border for the modal */
        }
        .modal-header .btn-close {
            filter: invert(1); /* Make close button white */
        }
    </style>

<body>


<div class="header">
        <img src="eticphoto.png" alt="Profile Image">
    </div>
    <div class="container mt-5">
        <h1 class="mb-4">Logout Confirmation</h1>

        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form action="logout.php" method="POST">
            <div class="mb-3">
                <label for="code" class="form-label">Enter Confirmation Code</label>
                <input type="text" class="form-control" id="code" name="code" required>
            </div>
            <button type="submit" class="btn btn-primary">Logout</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
