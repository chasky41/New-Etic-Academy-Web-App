<?php
include('db_connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM rendezvous WHERE id=$id");
    $rendezvous = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];

    $stmt = $conn->prepare("UPDATE rendezvous SET nom=?, prenom=?, email=?, date=?, heure=? WHERE id=?");
    $stmt->bind_param("sssssi", $nom, $prenom, $email, $date, $heure, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: admin_meet_panel.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Modifier Rendez-vous</h1>
        <form action="edit_rendezvous.php" method="POST">
            <input type="hidden" name="id" value="<?= $rendezvous['id'] ?>">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= $rendezvous['nom'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $rendezvous['prenom'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $rendezvous['email'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="<?= $rendezvous['date'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="heure" class="form-label">Heure</label>
                <select class="form-select" id="heure" name="heure" required>
                    <option value="9:30" <?= $rendezvous['heure'] == '9:30' ? 'selected' : '' ?>>9:30 - 10:00</option>
                    <option value="10:00" <?= $rendezvous['heure'] == '10:00' ? 'selected' : '' ?>>10:00 - 10:30</option>
                    <!-- Ajoutez les autres options ici -->
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
</body>
</html>
