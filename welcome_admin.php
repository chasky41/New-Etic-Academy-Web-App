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

// Fetch student data
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: url('') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }
        .container {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
        }
        .table {
            background: #fff;
            color: #000;
            margin-bottom: 0;
        }
        .modal-content {
            background: #000; /* Black background for modal */
            color: #fff; /* White text color */
        }
        .btn-primary, .btn-warning, .btn-danger {
            border: none;
        }
        .btn-primary {
            background: #007bff;
        }
        .btn-warning {
            background: #ffc107;
        }
        .btn-danger {
            background: #dc3545;
        }
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .table-responsive {
            margin-top: 20px;
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
        <h1 class="text-center mb-4">Welcome Admin</h1>
        <div class="d-flex justify-content-between mb-4">
            <!-- Add Student Button -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="fas fa-user-plus"></i> Add Student
            </button>
            <!-- Trigger logout modal -->
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>

          
            <a href="admin_messagerie.php" class="btn btn-info">Gestion Élèves et messagerie</a>

            <a href="export_excel.php" class="btn btn-success"><i class="fas fa-file-excel"></i> Export to Excel</a>
            <!-- New button to manage professors -->
            <a href="gestion_prof.php" class="btn btn-info"><i class="fas fa-chalkboard-teacher"></i> Manage Professors / Students</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Profile</th>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Address</th>
                        <th>Course</th>
                        <th>Country Code</th>
                        <th>Date of Birth</th>
                        <th>Country of Birth</th>
                        <th>Degree</th>
                        <th>CV</th>
                        <th>Motivation Letter</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr data-id="<?php echo $row['id']; ?>">
                                <td><img src="<?php echo htmlspecialchars($row['photo']); ?>" alt="Profile" class="profile-img"></td>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td class="first-name"><?php echo htmlspecialchars($row['first_name']); ?></td>
                                <td class="last-name"><?php echo htmlspecialchars($row['last_name']); ?></td>
                                <td class="email"><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="phone"><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td class="city"><?php echo htmlspecialchars($row['city']); ?></td>
                                <td class="country"><?php echo htmlspecialchars($row['country']); ?></td>
                                <td class="address"><?php echo htmlspecialchars($row['address']); ?></td>
                                <td class="course"><?php echo htmlspecialchars($row['course']); ?></td>
                                <td class="country-code"><?php echo htmlspecialchars($row['country_code']); ?></td>
                                <td class="dob"><?php echo htmlspecialchars($row['dob']); ?></td>
                                <td class="birth-country"><?php echo htmlspecialchars($row['birth_country']); ?></td>
                                <td class="degree"><?php echo htmlspecialchars($row['degree']); ?></td>
                                <td><a href="<?php echo htmlspecialchars($row['cv']); ?>" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-file-pdf"></i> View</a></td>
                                <td><a href="<?php echo htmlspecialchars($row['motivation_letter']); ?>" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-file-pdf"></i> View</a></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editStudent(<?php echo $row['id']; ?>)"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteStudent(<?php echo $row['id']; ?>)"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="17" class="text-center">No students found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addForm" action="add_student.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="addFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="addFirstName" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="addLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="addLastName" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="addEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="addEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="addPhone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="addPhone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="addCity" class="form-label">City</label>
                            <input type="text" class="form-control" id="addCity" name="city" required>
                        </div>
                        <div class="mb-3">
                            <label for="addCountry" class="form-label">Country</label>
                            <input type="text" class="form-control" id="addCountry" name="country" required>
                        </div>
                        <div class="mb-3">
                            <label for="addAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="addAddress" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="addCourse" class="form-label">Course</label>
                            <input type="text" class="form-control" id="addCourse" name="course" required>
                        </div>
                        <div class="mb-3">
                            <label for="addCountryCode" class="form-label">Country Code</label>
                            <input type="text" class="form-control" id="addCountryCode" name="country_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="addDob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="addDob" name="dob" required>
                        </div>
                        <div class="mb-3">
                            <label for="addBirthCountry" class="form-label">Country of Birth</label>
                            <input type="text" class="form-control" id="addBirthCountry" name="birth_country" required>
                        </div>
                        <div class="mb-3">
                            <label for="addDegree" class="form-label">Degree</label>
                            <input type="text" class="form-control" id="addDegree" name="degree" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" action="edit_student.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-3">
                            <label for="editFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="editFirstName" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="editLastName" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPhone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="editPhone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCity" class="form-label">City</label>
                            <input type="text" class="form-control" id="editCity" name="city" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCountry" class="form-label">Country</label>
                            <input type="text" class="form-control" id="editCountry" name="country" required>
                        </div>
                        <div class="mb-3">
                            <label for="editAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="editAddress" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCourse" class="form-label">Course</label>
                            <input type="text" class="form-control" id="editCourse" name="course" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCountryCode" class="form-label">Country Code</label>
                            <input type="text" class="form-control" id="editCountryCode" name="country_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="editDob" name="dob" required>
                        </div>
                        <div class="mb-3">
                            <label for="editBirthCountry" class="form-label">Country of Birth</label>
                            <input type="text" class="form-control" id="editBirthCountry" name="birth_country" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDegree" class="form-label">Degree</label>
                            <input type="text" class="form-control" id="editDegree" name="degree" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to logout?
                </div>
                <div class="modal-footer">
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function editStudent(id) {
    var row = document.querySelector(`tr[data-id='${id}']`);  // Corrected template string
    document.getElementById('editId').value = id;
    document.getElementById('editFirstName').value = row.querySelector('.first-name').innerText;
    document.getElementById('editLastName').value = row.querySelector('.last-name').innerText;
    document.getElementById('editEmail').value = row.querySelector('.email').innerText;
    document.getElementById('editPhone').value = row.querySelector('.phone').innerText;
    document.getElementById('editCity').value = row.querySelector('.city').innerText;
    document.getElementById('editCountry').value = row.querySelector('.country').innerText;
    document.getElementById('editAddress').value = row.querySelector('.address').innerText;
    document.getElementById('editCourse').value = row.querySelector('.course').innerText;
    document.getElementById('editCountryCode').value = row.querySelector('.country-code').innerText;
    document.getElementById('editDob').value = row.querySelector('.dob').innerText;
    document.getElementById('editBirthCountry').value = row.querySelector('.birth-country').innerText;
    document.getElementById('editDegree').value = row.querySelector('.degree').innerText;

    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
}


      function deleteStudent(id) {
    if (confirm('Are you sure you want to delete this student?')) {
        // Navigate to the delete_student.php script with the correct student ID
        window.location.href = 'delete_student.php?id=' + id;
    }
}

    </script>
</body>
</html>

<?php $conn->close(); ?>