<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot ETIC Academy</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }
        .chat-container {
            max-width: 400px;
            margin: 50px auto;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }
        .chat-box {
            height: 300px;
            overflow-y: scroll;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        .message {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }
        .message.user {
            align-items: flex-end;
        }
        .message.bot {
            align-items: flex-start;
        }
        .message p {
            max-width: 75%;
            padding: 10px 15px;
            border-radius: 20px;
            margin: 0;
        }
        .message.user p {
            background-color: #007bff;
            color: white;
            border-radius: 20px 20px 0 20px;
        }
        .message.bot p {
            background-color: #eee;
            border-radius: 20px 20px 20px 0;
        }
        .question-buttons {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .question-buttons button {
            margin: 5px 0;
            width: 48%;
            border-radius: 20px;
        }
        .spinner-border {
            display: none;
            width: 2rem;
            height: 2rem;
            margin: 10px auto;
            color: #007bff;
        }
        #user-input {
            width: calc(100% - 50px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            outline: none;
            font-size: 14px;
        }
        #send-btn {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            outline: none;
            cursor: pointer;
        }
        .dark-mode .chat-container {
            background-color: #333;
            color: #ddd;
        }
        .dark-mode .chat-box {
            background-color: #444;
        }
        .dark-mode .message.user p {
            background-color: #0056b3;
        }
        .dark-mode .message.bot p {
            background-color: #555;
        }
        .dark-mode #user-input {
            border: 1px solid #666;
            background-color: #555;
            color: #ddd;
        }
        .dark-mode #send-btn {
            background-color: #0056b3;
        }
        .toggle-theme {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .toggle-theme button {
            margin-left: 10px;
            border-radius: 50%;
        }
    </style>
</head>




<body>



    <div class="container chat-container">
        <h4 class="text-center">Chatbot ETIC Academy</h4>
        <div class="toggle-theme text-center">
            <i id="theme-icon" class="fas fa-sun"></i>
            <button class="btn btn-outline-secondary" id="toggle-theme">Mode Sombre</button>
        </div>
        <div id="chat-box" class="chat-box">
            <!-- Les messages apparaîtront ici -->
        </div>
        <div class="question-buttons text-center">
            <button class="btn btn-outline-primary" onclick="sendMessage('type de formation')">Type de formation</button>
            <button class="btn btn-outline-primary" onclick="sendMessage('tarifs')">Tarifs</button>
            <button class="btn btn-outline-primary" onclick="sendMessage('horaires')">Horaires</button>
            <button class="btn btn-outline-primary" onclick="sendMessage('contact')">Contact</button>
            <button class="btn btn-outline-primary" onclick="sendMessage('inscription')">Inscription</button>
            <button class="btn btn-outline-primary" onclick="sendMessage('durée des formations')">Durée des formations</button>
            <button class="btn btn-outline-primary" onclick="sendMessage('formateurs')">Formateurs</button>
        </div>
        <div class="input-group">
            <input type="text" id="user-input" placeholder="Écrivez un message...">
            <button id="send-btn" onclick="sendInputMessage()">→</button>
        </div>
        <div class="text-center">
            <div class="spinner-border" role="status" id="spinner">
                <span class="sr-only">Chargement...</span>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        // Gestion du thème
        const toggleThemeButton = document.getElementById('toggle-theme');
        const themeIcon = document.getElementById('theme-icon');
        let darkMode = false;

        function toggleTheme() {
            darkMode = !darkMode;
            if (darkMode) {
                document.body.classList.add('dark-mode');
                toggleThemeButton.textContent = 'Mode Clair';
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            } else {
                document.body.classList.remove('dark-mode');
                toggleThemeButton.textContent = 'Mode Sombre';
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            }
        }

        toggleThemeButton.addEventListener('click', toggleTheme);

        function sendMessage(userInput) {
            addMessage('user', userInput);
            $('#spinner').show();

            $.ajax({
                url: 'api_chatbot.php',
                type: 'POST',
                dataType: 'json',
                data: { message: userInput },
                success: function(response) {
                    $('#spinner').hide();
                    if (response.response) {
                        addMessage('bot', response.response);
                    } else {
                        addMessage('bot', "Désolé, je n'ai pas compris votre question. Veuillez accéder à la page <a href='contact.html'>Contact</a> pour poser vos questions ou obtenir plus d'informations.");
                    }
                },
                error: function() {
                    $('#spinner').hide();
                    addMessage('bot', "Désolé, une erreur s'est produite. Veuillez réessayer plus tard.");
                }
            });
        }

        function sendInputMessage() {
            let userInput = $('#user-input').val().trim();
            if (userInput !== "") {
                sendMessage(userInput);
                $('#user-input').val('');
            }
        }

        function addMessage(sender, text) {
            let messageHtml = '<div class="message ' + sender + '"><p>' + text + '</p></div>';
            $('#chat-box').append(messageHtml);
            $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
        }

        $('#user-input').keypress(function(event) {
            if (event.which == 13) {
                sendInputMessage();
            }
        });
    </script>
</body>
</html>


