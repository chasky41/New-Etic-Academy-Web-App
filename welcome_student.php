<?php
session_start();
if ($_SESSION['user'] !== 'student') {
    header('Location: index.html');
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
$sql = "SELECT submitted FROM students WHERE email='$email'";
$result = $conn->query($sql);

$alreadySubmitted = false;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $alreadySubmitted = $row['submitted'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .progress-bar {
            transition: width 0.5s;

            
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
    <div class="container mt-5">
        <h1 class="text-center">Welcome Student</h1>
        <?php if ($alreadySubmitted): ?>
            <div class="alert alert-info text-center">
                Vous avez déjà effectué une demande.
            </div>
        <?php else: ?>
            <div class="progress mb-3">
                <div id="progressBar" class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" aria-controls="personal" aria-selected="true">Personal Info</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link disabled" id="experience-tab" data-bs-toggle="tab" data-bs-target="#experience" type="button" role="tab" aria-controls="experience" aria-selected="false" tabindex="-1" aria-disabled="true">Experience</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link disabled" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button" role="tab" aria-controls="documents" aria-selected="false" tabindex="-1" aria-disabled="true">Documents</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!-- Personal Info Form -->
                <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                    <form id="personalForm" class="mt-3">
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="last_name" required>
                        </div>
                        <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <small class="form-text text-danger">* Obligatoire : utiliser l'email de connexion</small>
                          </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" name="country" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="course" class="form-label">Course</label>
                            <select class="form-control" id="course" name="course" required>
                                <option value="Informatique">Informatique</option>
                                <option value="Commerce">Commerce</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="countryCode" class="form-label">Country Code</label>
                            <input type="text" class="form-control" id="countryCode" name="country_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>
                        <div class="mb-3">
                            <label for="birthCountry" class="form-label">Country of Birth</label>
                            <input type="text" class="form-control" id="birthCountry" name="birth_country" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="showExperience()">Suivant</button>
                    </form>
                </div>
                <!-- Experience Form -->
                <div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="experience-tab">
                    <form id="experienceForm" class="mt-3">
                        <div class="mb-3">
                            <label for="degree" class="form-label">Last Degree</label>
                            <input type="text" class="form-control" id="degree" name="degree" required>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="showPersonal()">Revenir</button>
                        <button type="button" class="btn btn-primary" onclick="showDocuments()">Suivant</button>
                    </form>
                </div>
                <!-- Documents Form -->
                <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                    <form id="documentsForm" class="mt-3" action="process_student_forms.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="first_name" id="doc_firstName">
                        <input type="hidden" name="last_name" id="doc_lastName">
                        <input type="hidden" name="email" id="doc_email">
                        <input type="hidden" name="phone" id="doc_phone">
                        <input type="hidden" name="city" id="doc_city">
                        <input type="hidden" name="country" id="doc_country">
                        <input type="hidden" name="address" id="doc_address">
                        <input type="hidden" name="course" id="doc_course">
                        <input type="hidden" name="country_code" id="doc_countryCode">
                        <input type="hidden" name="dob" id="doc_dob">
                        <input type="hidden" name="birth_country" id="doc_birthCountry">
                        <input type="hidden" name="experience" id="doc_experience">
                        <input type="hidden" name="degree" id="doc_degree">
                        <div class="mb-3">
                            <label for="photo" class="form-label">Upload Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="cv" class="form-label">Upload CV</label>
                            <input type="file" class="form-control" id="cv" name="cv" accept=".pdf" required>
                        </div>
                        <div class="mb-3">
                            <label for="motivationLetter" class="form-label">Upload Motivation Letter</label>
                            <input type="file" class="form-control" id="motivationLetter" name="motivation_letter" accept=".pdf" required>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="showExperience()">Revenir</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateProgressBar(percentage) {
            document.getElementById('progressBar').style.width = percentage + '%';
            document.getElementById('progressBar').setAttribute('aria-valuenow', percentage);
        }

        function showPersonal() {
            updateProgressBar(33);
            var tabTrigger = new bootstrap.Tab(document.getElementById('personal-tab'));
            tabTrigger.show();
        }

        function showExperience() {
            if (validatePersonalForm()) {
                updateProgressBar(66);
                var experienceTab = document.getElementById('experience-tab');
                experienceTab.classList.remove('disabled');
                experienceTab.removeAttribute('tabindex');
                experienceTab.setAttribute('aria-selected', 'false');
                experienceTab.removeAttribute('aria-disabled');

                var tabTrigger = new bootstrap.Tab(experienceTab);
                tabTrigger.show();
                transferPersonalData();
            } else {
                alert("Veuillez remplir tous les champs du formulaire d'informations personnelles avant de passer à l'expérience.");
            }
        }

        function showDocuments() {
            if (validateExperienceForm()) {
                updateProgressBar(100);
                var documentsTab = document.getElementById('documents-tab');
                documentsTab.classList.remove('disabled');
                documentsTab.removeAttribute('tabindex');
                documentsTab.setAttribute('aria-selected', 'false');
                documentsTab.removeAttribute('aria-disabled');

                var tabTrigger = new bootstrap.Tab(documentsTab);
                tabTrigger.show();
                transferExperienceData();
            } else {
                alert("Veuillez remplir tous les champs du formulaire d'expérience avant de passer aux documents.");
            }
        }

        function validatePersonalForm() {
            const personalForm = document.getElementById('personalForm');
            if (!personalForm.checkValidity()) {
                personalForm.reportValidity();
                return false;
            }
            return true;
        }

        function validateExperienceForm() {
            const experienceForm = document.getElementById('experienceForm');
            if (!experienceForm.checkValidity()) {
                experienceForm.reportValidity();
                return false;
            }
            return true;
        }

        function transferPersonalData() {
            document.getElementById('doc_firstName').value = document.getElementById('firstName').value;
            document.getElementById('doc_lastName').value = document.getElementById('lastName').value;
            document.getElementById('doc_email').value = document.getElementById('email').value;
            document.getElementById('doc_phone').value = document.getElementById('phone').value;
            document.getElementById('doc_city').value = document.getElementById('city').value;
            document.getElementById('doc_country').value = document.getElementById('country').value;
            document.getElementById('doc_address').value = document.getElementById('address').value;
            document.getElementById('doc_course').value = document.getElementById('course').value;
            document.getElementById('doc_countryCode').value = document.getElementById('countryCode').value;
            document.getElementById('doc_dob').value = document.getElementById('dob').value;
            document.getElementById('doc_birthCountry').value = document.getElementById('birthCountry').value;
        }

        function transferExperienceData() {
            document.getElementById('doc_experience').value = document.getElementById('experience').value;
            document.getElementById('doc_degree').value = document.getElementById('degree').value;
        }
    </script>
</body>
</html>
