<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'student') {
    header('Location: login_etudiant.php');
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

$email = $_SESSION['email'];
$sql = "SELECT * FROM messages WHERE recipient_email = ? ORDER BY date_sent DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f9fc;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 900px;
            margin-top: 50px;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }


        .logo {
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
          
            border-radius: 50%;
            overflow: hidden;
            background-color: #007bff; /* Blue background for the logo */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .logo img {
            width: 100%;
            height: auto;
        }
        h1, h2 {
            margin-bottom: 20px;
            color: #333333;
        }
        .list-group-item {
            margin-bottom: 15px;
            border-radius: 5px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }
        .list-group-item strong {
            display: block;
            margin-bottom: 5px;
            color: #007bff;
        }
        .list-group-item a {
            color: #007bff;
        }
        .list-group-item a:hover {
            text-decoration: underline;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            margin-top: 20px;
        }
        .btn-back i {
            margin-right: 8px;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h1 class="text-center">Messagerie</h1>
         <div class="logo">
            <img src="eticphoto.png" alt="Logo"> <!-- Replace with your logo file -->
        </div>
        <!-- Message Display -->
        <h2>Vos Messages</h2>
        <ul class="list-group">
            <?php while ($message = $result->fetch_assoc()): ?>
            <li class="list-group-item">
                <strong><?php echo htmlspecialchars($message['subject']); ?></strong>
                <p><?php echo nl2br(htmlspecialchars($message['body'])); ?></p>
                <p class="text-muted"><em>Envoyé le: <?php echo htmlspecialchars($message['date_sent']); ?></em></p>
                <?php if ($message['pdf_file']): ?>
                <a href="uploads/<?php echo htmlspecialchars($message['pdf_file']); ?>" target="_blank">
                    <i class="fas fa-file-pdf"></i> Voir le fichier PDF
                </a>
                <?php endif; ?>
            </li>
            <?php endwhile; ?>
        </ul>
        
        <!-- New Message Form -->
        <h2>Envoyer un Message</h2>
        <form action="send_message.php" method="POST" enctype="multipart/form-data" class="mt-4">
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
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        
        <a href="dashboard_etudiant.php" class="btn btn-primary btn-back">
            <i class="fas fa-arrow-left"></i> Retour au Dashboard
        </a>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
