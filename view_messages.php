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

$student_id = isset($_GET['student_id']) ? intval($_GET['student_id']) : 0;

// Fetch student's email to get messages
$sql_student = "SELECT email FROM students WHERE id = ?";
$stmt_student = $conn->prepare($sql_student);
$stmt_student->bind_param("i", $student_id);
$stmt_student->execute();
$result_student = $stmt_student->get_result();
$student = $result_student->fetch_assoc();
$student_email = $student['email'];

$sql = "SELECT * FROM messages WHERE recipient_email = ? ORDER BY date_sent DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages de l'Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Messages de l'Étudiant</h1>
        
        <!-- Message Display -->
        <ul class="list-group">
            <?php while ($message = $result->fetch_assoc()): ?>
            <li class="list-group-item">
                <strong><?php echo htmlspecialchars($message['subject']); ?></strong> <br>
                <?php echo nl2br(htmlspecialchars($message['body'])); ?> <br>
                <em>Envoyé le: <?php echo htmlspecialchars($message['date_sent']); ?></em>
                <?php if ($message['pdf_file']): ?>
                <br><a href="uploads/<?php echo htmlspecialchars($message['pdf_file']); ?>" target="_blank">Voir le fichier PDF</a>
                <?php endif; ?>
            </li>
            <?php endwhile; ?>
        </ul>
        
        <a href="admin_messagerie.php" class="btn btn-primary mt-3">Retour à la messagerie admin</a>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
