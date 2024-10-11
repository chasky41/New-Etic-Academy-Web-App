<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: admin_window.php');
    exit();
}

include('db_connect.php');

// Récupérer les données des rendez-vous depuis la base de données
$stmt = $conn->prepare("SELECT id, nom, prenom, email, date, heure, importance FROM rendezvous");
$stmt->execute();
$result = $stmt->get_result();

// Gestion de la déconnexion avec vérification du code de confirmation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmation_code'])) {
    $confirmationCode = $_POST['confirmation_code'];
    // Vérifiez ici le code de confirmation
    if ($confirmationCode === '12345') { // Remplacez '12345' par le code de confirmation souhaité
        session_unset();
        session_destroy();
        header('Location: admin_window.php');
        exit();
    } else {
        $error = 'Code de confirmation incorrect.';
    }
}

// Action pour marquer ou démarrer un rendez-vous comme important
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = intval($_GET['id']);

    if ($action === 'toggle_importance') {
        // Vérifiez l'état actuel de l'importance
        $checkStmt = $conn->prepare("SELECT importance FROM rendezvous WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $resultCheck = $checkStmt->get_result();
        $row = $resultCheck->fetch_assoc();

        // Toggle importance
        $newImportance = $row['importance'] ? 0 : 1; // Toggle between 1 and 0
        $updateStmt = $conn->prepare("UPDATE rendezvous SET importance = ? WHERE id = ?");
        $updateStmt->bind_param("ii", $newImportance, $id);
        $updateStmt->execute();
        $updateStmt->close();
        $checkStmt->close();
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Demandes de Rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
<div class="header">
    <img src="eticphoto.png" alt="Profile Image">
</div>
<div class="container mt-5">
    <h1>Demandes de Rendez-vous</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Importance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['nom']) ?></td>
                    <td><?= htmlspecialchars($row['prenom']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['date']) ?></td>
                    <td><?= htmlspecialchars($row['heure']) ?></td>
                    <td><?= $row['importance'] ? 'Important' : 'Normal' ?></td>
                    <td>
                        <a href="?action=toggle_importance&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">
                            <?= $row['importance'] ? 'Démarquer' : 'Marquer Important' ?>
                        </a>
                        <a href="edit_rendezvous.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Modifier</a>
                        <a href="delete_rendezvous.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#logoutModal">Déconnexion</button>
</div>

<!-- Modal pour le code de confirmation -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirmation de déconnexion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="logoutForm" action="" method="POST">
                    <div class="mb-3">
                        <label for="confirmationCode" class="form-label">Entrez le code de confirmation</label>
                        <input type="text" class="form-control" id="confirmationCode" name="confirmation_code" required>
                    </div>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary" onclick="submitLogout()">Confirmer</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
<script>
    function submitLogout() {
        var code = document.getElementById('confirmationCode').value;
        // Vérification basique du code
        if (code === '12345') { // Remplacez '12345' par votre code de confirmation
            document.getElementById('logoutForm').submit();
        } else {
            alert('Code de confirmation incorrect.');
        }
    }
</script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
