<?php
session_start();
if ($_SESSION['user'] !== 'admin') {
    header('Location: index.html');
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle CRUD operations
$action = isset($_GET['action']) ? $_GET['action'] : '';
if ($action == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM professors WHERE id=$id");
}

// Fetch professors data
$sql = "SELECT * FROM professors";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Professors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .container {
            margin-top: 50px;
        }
        .table-responsive {
            transition: all 0.3s ease;
        }
        .table {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .profile-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .profile-img:hover {
            transform: scale(1.1);
        }
        .btn-icon {
            font-size: 1.2rem;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
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
</head>
<body>

<div class="header">
        <img src="eticphoto.png" alt="Profile Image">
    </div>
     <div class="container">
        <h1 class="text-center mb-4">Manage Professors</h1>
        <div class="d-flex justify-content-between mb-4">
            <a href="add_prof.php" class="btn btn-primary btn-icon">
                <i class="fas fa-user-plus"></i> Add Professor
            </a>
            <a href="http://localhost/Nouveau%20dossier_test/Rendez-vous/admin_window.php" class="btn btn-info btn-icon">
                <i class="fas fa-calendar-check"></i> Student Appointments
            </a>
            <a href="welcome_admin.php" class="btn btn-secondary btn-icon"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr data-id="<?php echo $row['id']; ?>">
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><img src="<?php echo htmlspecialchars($row['photo']); ?>" alt="Photo" class="profile-img"></td>
                                <td class="first-name"><?php echo htmlspecialchars($row['first_name']); ?></td>
                                <td class="last-name"><?php echo htmlspecialchars($row['last_name']); ?></td>
                                <td class="email"><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="phone"><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td class="department"><?php echo htmlspecialchars($row['department']); ?></td>
                                <td>
                                    <a href="update_prof.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm btn-icon" title="Edit Professor"><i class="fas fa-edit"></i></a>
                                    <a href="delete_prof.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm btn-icon" title="Delete Professor" onclick="return confirm('Are you sure you want to delete this professor?');"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">No professors found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
