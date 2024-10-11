<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande déjà soumise</title>
    <!-- Inclure Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .box-shadow-lg {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>
<body class="bg-light d-flex justify-content-center align-items-center min-vh-100 mb-0">
    <div class="container">
        <!-- Box 1: Header -->
        <div class="box-shadow-lg bg-white p-4 rounded mb-4 text-center">
            <h1 class="text-danger">Vous êtes déposer une candidature !!</h1>
        </div>

        
        <!-- Box 3: Warning Message -->
        <div class="box-shadow-lg bg-white p-4 rounded mb-4 text-center">
            <p class="text-warning">Veuillez noter qu'une duplication de candidature entraîne une annulation. Un conseiller vous contactera dans les plus brefs délais. Merci.</p>
        </div>
        
        <!-- Box 4: Button -->
        <div class="box-shadow-lg bg-white p-4 rounded text-center">
            <a href="profile_succeeded_request.php" class="btn btn-primary">Voir le profil personnel</a>
        </div>
    </div>
    <!-- Inclure Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
