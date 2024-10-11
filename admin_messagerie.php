<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header('Location: login_admin.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Réception de la requête AJAX pour mettre à jour le statut
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['student_id']) && isset($_POST['status'])) {
    $student_id = $_POST['student_id'];
    $status = $_POST['status'];

    // Mise à jour du statut dans la base de données
    $sql_update = "UPDATE students SET dossier_status = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("si", $status, $student_id);

    if ($stmt_update->execute()) {
        // Récupérer l'email de l'étudiant
        $sql_email = "SELECT email FROM students WHERE id = ?";
        $stmt_email = $conn->prepare($sql_email);
        $stmt_email->bind_param("i", $student_id);
        $stmt_email->execute();
        $result_email = $stmt_email->get_result();
        $student = $result_email->fetch_assoc();

        $recipient_email = $student['email'];
        $subject = "Mise à jour de votre statut de dossier";
        $body = "Bonjour, votre dossier a été mis à jour. Le nouveau statut est : " . $status;

        // Envoi du message à l'étudiant (ici vous pouvez remplacer par une fonction d'envoi d'email réelle)
        // mail($recipient_email, $subject, $body); // Pour un vrai envoi d'email

        $message = '<div class="alert alert-success" role="alert">Statut mis à jour et message envoyé à l\'étudiant.</div>';

        // Envoyer la réponse à la requête AJAX
        echo json_encode(['success' => true, 'message' => $message]);
    } else {
        echo json_encode(['success' => false, 'message' => '<div class="alert alert-danger" role="alert">Erreur lors de la mise à jour.</div>']);
    }
    exit();
}

// Filtrer par ID et nom pour l'affichage des étudiants
$search_id = "";
$search_name = "";
if (isset($_GET['search_id'])) {
    $search_id = $_GET['search_id'];
}
if (isset($_GET['search_name'])) {
    $search_name = $_GET['search_name'];
}

$sql_students = "SELECT DISTINCT id, first_name, last_name, email, dossier_status 
                 FROM students 
                 WHERE id LIKE ? 
                 AND (first_name LIKE ? OR last_name LIKE ?)";
$stmt_students = $conn->prepare($sql_students);
$search_id_param = "%" . $search_id . "%";
$search_name_param = "%" . $search_name . "%";
$stmt_students->bind_param("sss", $search_id_param, $search_name_param, $search_name_param);
$stmt_students->execute();
$result_students = $stmt_students->get_result();

// Envoyer un message à l'étudiant
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_message'])) {
    $recipient_email = $_POST['recipient_email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $pdf_file = $_FILES['pdf_file']['name'];

    if ($pdf_file) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($pdf_file);
        move_uploaded_file($_FILES['pdf_file']['tmp_name'], $target_file);
    }

    $sql = "INSERT INTO messages (recipient_email, subject, body, pdf_file) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $recipient_email, $subject, $body, $pdf_file);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success" role="alert">Message envoyé avec succès.</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'envoi du message.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Messagerie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
        }
        h1, h2 {
            color: #007bff;
        }
        table {
            background-color: #ffffff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .form-control {
            border-radius: 0.25rem;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .filter-form {
            margin-bottom: 20px;
        }
        .btn-back {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-back:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .back-btn-container {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
    <div class="header">
       <center><img src="eticphoto.png" alt="Profile Image"><center> 
    </div>
        <div class="back-btn-container">
            <a href="http://localhost/Nouveau%20dossier_test/welcome_admin.php" class="btn btn-back">
                Retour à l'accueil admin &rarr;
            </a>
        </div>

        <h1 class="text-center">Admin - Messagerie</h1>

        <!-- Affichage des messages -->
        <div id="status-message"></div>

        <!-- Formulaire de recherche avec deux filtres distincts -->
        <form method="GET" class="filter-form">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="search_id" placeholder="Filtrer par ID" value="<?php echo htmlspecialchars($search_id); ?>">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="search_name" placeholder="Filtrer par Nom" value="<?php echo htmlspecialchars($search_name); ?>">
                </div>
            </div>
            <button class="btn btn-primary mt-3" type="submit">Rechercher</button>
        </form>

        <!-- Liste des étudiants -->
        <h2>Étudiants</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>État du dossier</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($student = $result_students->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['id']); ?></td>
                    <td><?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($student['email']); ?></td>
                    <td>
                        <select name="status" class="form-select form-select-sm" data-student-id="<?php echo htmlspecialchars($student['id']); ?>">
                            <option value="En cours" <?php if ($student['dossier_status'] == "En cours") echo "selected"; ?>>En cours</option>
                            <option value="Annulé" <?php if ($student['dossier_status'] == "Annulé") echo "selected"; ?>>Annulé</option>
                            <option value="Accepté" <?php if ($student['dossier_status'] == "Accepté") echo "selected"; ?>>Accepté</option>
                        </select>
                    </td>
                    <td>
                        <a href="view_messages.php?student_id=<?php echo htmlspecialchars($student['id']); ?>" class="btn btn-primary btn-sm">Voir Messages</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Formulaire d'envoi de message -->
        <h2>Envoyer un Message</h2>
        <form action="admin_messagerie.php" method="POST" enctype="multipart/form-data" class="mt-4">
            <div class="mb-3">
                <label for="recipient_email" class="form-label">Email de l'étudiant</label>
                <input type="email" class="form-control" id="recipient_email" name="recipient_email" required>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Objet</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Message</label>
                <textarea class="form-control" id="body" name="body" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="pdf_file" class="form-label">Fichier PDF (optionnel)</label>
                <input type="file" class="form-control" id="pdf_file" name="pdf_file">
            </div>
            <button type="submit" name="send_message" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Écouteur de changement pour les sélecteurs d'état de dossier
            $("select[name='status']").change(function() {
                var studentId = $(this).data("student-id");
                var status = $(this).val();

                $.ajax({
                    url: "admin_messagerie.php",
                    type: "POST",
                    data: {
                        student_id: studentId,
                        status: status
                    },
                    dataType: "json",
                    success: function(response) {
                        // Affichage des messages de succès ou d'erreur
                        if (response.success) {
                            $('#status-message').html(response.message).fadeIn();
                        } else {
                            $('#status-message').html(response.message).fadeIn();
                        }
                        setTimeout(function() {
                            $('#status-message').fadeOut();
                        }, 3000);
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php $conn->close(); ?>
