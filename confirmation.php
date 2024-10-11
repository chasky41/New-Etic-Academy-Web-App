<?php
session_start();
if ($_SESSION['user'] !== 'student') {
    header('Location: index.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .confirmation-container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        #loading-indicator {
            font-size: 50px;
            color: #007bff;
        }
        .success-icon {
            font-size: 50px;
            color: #28a745;
            display: none;
        }
        .confirmation-message {
            font-size: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <div id="loading-indicator">
            <i class="fas fa-spinner fa-spin"></i>
        </div>
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="confirmation-message">
            <!-- Message hidden initially; displayed after transition -->
        </div>
        <a href="index.html" class="btn btn-primary mt-3">Retour à l'accueil</a>
    </div>

    <!-- Bootstrap Modal for Notification -->
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    L'équipe Etic Academy va te contacter dans les plus brefs délais.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        window.addEventListener("load", function() {
            // Hide loading indicator and show success icon
            document.getElementById("loading-indicator").style.display = "none";
            document.querySelector(".success-icon").style.display = "block";
            document.querySelector(".confirmation-message").innerText = 'Votre candidature a été envoyée avec succès.';
            
            // Show the modal with confirmation message
            var notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
            notificationModal.show();
        });
    </script>
</body>
</html>
