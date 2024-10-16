<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>site</title>

    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS (for the user icon) -->
    <!-- Bootstrap CSS pour le Carousel -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- script-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>





    <link rel="stylesheet" href="./style.css">

</head>

<body>

    <!--navbar -->
     <!--navbar -->
     <style>
        /* Incluez ici le CSS pour l'écran de chargement */
        #loadingScreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        .loading-logo {
            max-width: 300px;
            margin-bottom: 20px;
        }

        .loading-text {
            font-size: 24px;
            color: #3498db;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-logo img {
            animation: spin 2s linear infinite;
        }
    </style>
</head>
<body>
    <!-- Votre barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand mr-4" href="../site/index.html">
            <img src="./img/logo.png" alt="Your Logo">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="../site/index.html">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="../A propos/index.html">Etic Academy</a></li>
                <li class="nav-item"><a class="nav-link" href="../pagexx/formation.html">Prés requis</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="etudiantDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Etudiant</a>
                    <ul class="dropdown-menu" aria-labelledby="etudiantDropdown">
                        <li><a class="dropdown-item" href="../commerce/index.html">Commerce</a></li>
                        <li><a class="dropdown-item" href="../informatique/index.html">Informatique</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="../le menu/menu.html">Nos Formation</a></li>
                <li class="nav-item"><a class="nav-link" href="../page-template/index.html">Diplome</a></li>
                <li class="nav-item"><a class="nav-link" href="../contact/index.html">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="../Rendez-vous/rendezvous-eleves.php">Rendez-vous</a></li>
                <li class="nav-item"><a class="nav-link" href="../index.html">Login</a></li>
            </ul>
        
            <!-- User icon on the right -->
            <ul class="navbar-nav ms-auto navbar-nav-right">
                <li class="nav-item"><a class="nav-link" href="../index.html"><i class="fas fa-user"></i></a></li>
            </ul>
        </div> 
    </nav>

    <!-- Votre contenu principal -->

    <!-- Écran de chargement -->
    <div id="loadingScreen">
        <div class="loading-logo">
            <img src="../eticphoto.png" alt="Etic Academy Logo">
        </div><br><br>
        <div class="loading-text"><b style="color: red;">Etic  <span style="color:blue;">Academy</span></b>  </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loadingScreen = document.getElementById("loadingScreen");

            // Afficher l'écran de chargement
            loadingScreen.style.display = "flex";

            // Masquer l'écran de chargement après 5 secondes
            setTimeout(function() {
                loadingScreen.style.display = "none";
            }, 1500); // Délai de 5 secondes
        });
    </script>

      


<body>

  <section class="sec1">
        <div class="container-fluid">
            
            <div class="row justify-content-around">
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">
                 
                    <img src="meeting.jpg" alt="student">
           
                </div>
                <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12">
                  
                    <div class="text">
    <h2>Besoin de Conseils ?</h2>
    <h5>Nos conseillers sont là pour vous guider vers le succès !</h5>
    <ol>
        <li>RENDEZ-VOUS PERSONNALISÉS :</li>
        <p>Discutez avec nos experts pour obtenir des conseils adaptés à vos besoins en formation et en carrière.</p>

        <li>UN ACCOMPAGNEMENT DE QUALITÉ :</li>
        <p>Nos conseillers sont disponibles pour vous aider à choisir les formations qui correspondent à vos objectifs professionnels.</p>

        <li>UN SUIVI DÉDIÉ :</li>
        <p>Profitez d'un suivi personnalisé tout au long de votre parcours avec ETIC ACADEMY.</p>
    </ol>
    <button><a href="form_rendezvous.php">Prendre Rendez-vous</a></button>
</div>

          
            </div>
          
            </div>
        </div>
    </section>
  

    
<br><br><br><br><br>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
</body>
</html>
<br><br><br>




    <section class="sec6">
        <div class="container-fluid">
            <div class="txt">
                
            <div class="row">
                <div class="col">
                    <center>
                    <h3>Je veux me former avec ETIC ACADEMY</h3>
                    <h5>Je souhaite connaitre les programmes et les prix des formations</h5>
                </center>
                </div>
                
            </div>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Formulaire de Contact</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    .container-fluid {
                        padding: 30px;
                    }
                    .form {
                        background-color: #f8f9fa;
                        padding: 20px;
                        border-radius: 8px;
                    }
                    .btn1 {
                        display: flex;
                        align-items: center;
                    }
                    .btn1 svg {
                        margin-left: 5px;
                    }
                </style>
            </head>
            <body>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <center>
                                <div class="form">
                                    <form id="contact-form" class="row justify-content-around g-3">
                                        <div class="col-sm-12 col-md-3 col-lg-3">
                                            <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Votre nom... *" required>
                                        </div>
                                        
                                        <div class="col-sm-12 col-md-3 col-lg-3">
                                            <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="Votre adresse email *" required>
                                        </div>
                                      
                                        <div class="col-sm-12 col-md-3 col-lg-3">
                                            <button type="submit" class="btn btn-primary btn1">
                                                Oui, merci
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            
                <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
                <script>
                    (function() {
                        emailjs.init("Tpj1wThy5wxMNYaVq"); // Remplacez par votre ID utilisateur EmailJS
                    })();
            
                    document.getElementById('contact-form').addEventListener('submit', function(event) {
                        event.preventDefault();
            
                        // Remplacez par les IDs de votre service et modèle EmailJS
                        const serviceID = 'service_0655p1j'; // Remplacez par l'ID de votre service
                        const templateID = 'template_d8h7gam'; // Remplacez par l'ID de votre modèle
            
                        emailjs.sendForm(serviceID, templateID, this)
                            .then((response) => {
                                console.log('Success:', response);
                                alert('Votre message a été envoyé avec succès!');
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                                alert('Erreur lors de l\'envoi de votre message.');
                            });
                    });
                </script>
            </body>
            </html>
        
            <div class="row">
                <center>
                <div class="col">
                    <p>En recevant nos programmes , vous consentez à ce qu'ETIC ACADEMY collecte vos données de vous envoyer des <br>
                    communications par voie électronique. Vouspourrez vous désabonner à tout moment.Consultez notre politique de <br>
                    confidentialité afin d'en savoir plus.</p>
                </div>
            </center>
            </div>
        </div>
        </div>
    </section>
    <!--footer-->
    <div class="container-fluid footer">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 order-md-1 footer-col footer-logo">
                        <img src="./img/logo.png" alt="Your Logo" class="img-fluid">
                    </div>
                    <!-- Second column with text and icons -->
                    <div class="col-md-3 order-md-2 footer-col">
                        <h4>Informations</h4>
                        <p>Etudiant</p>
                        <p>Étudiants étrangers</p>
                        <p>Dépôt de candidature</p>
                        <p>
                            <span class="icon-container"><i class="fas fa-phone phone-icon"></i></span>
                            +033 4 78 54 50 03
                        </p>
                        <p>
                            <span class="icon-container"><i class="fab fa-whatsapp whatsapp-icon"></i></span>
                            +033 7 69 71 96 01
                        </p>
                    </div>
    
                    <!-- Third column with text -->
                    <div class="col-md-3 order-md-3 footer-col">
                        <h4>Nos Formations</h4>
                        <p>Pôle Informatique</p>
                        <p>Pôle Commerciale</p>
                        <p><span class="icon-container"><i class="fas fa-envelope gmail-icon"></i></span>conseillers@etic-academy.com</p>
                    </div>
    
                    <!-- Fourth column with logos -->
                    <div class="col-md-3 order-md-4 footer-col fourth-column d-flex flex-column align-items-center">
                        <img src="./img/ppppp.png" alt="Logo 1" class="img-fluid">
                        <img src="./img/fo2.jpg" alt="Logo 1" class="img-fluid">
                        <img src="./img/fot3.jpg" alt="Logo 2" class="img-fluid">
                    </div>
                </div>
            </div>



    
            <!-- Blue banner at the bottom -->
                    <style>
                .icon-container {
                    font-size: 30px;
                    cursor: pointer;
                    color: #000;
                    margin: 0 10px;
                }
        
                .blue-banner {
                    text-align: center;
                    background-color: #007BFF;
                    color: white;
                    padding: 20px;
                    position: relative;
                }
        
                .social-icons {
                    display: flex;
                    justify-content: flex-start;
                    align-items: center;
                    margin-top: 10px;
                }
        
                .chat-popup {
                    display: none;
                    position: fixed;
                    bottom: 70px;
                    right: 20px;
                    width: 300px;
                    background-color: #f1f1f1;
                    border: 1px solid #888;
                    border-radius: 10px;
                    z-index: 9;
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                }
        
                .chat-header {
                    background-color: #4CAF50;
                    color: white;
                    padding: 10px;
                    border-radius: 10px 10px 0 0;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
        
                .chat-body {
                    max-height: 300px;
                    overflow-y: auto;
                    padding: 10px;
                    background-color: white;
                }
        
                .close-btn {
                    background: none;
                    border: none;
                    color: white;
                    font-size: 20px;
                    cursor: pointer;
                }
        
                input[type="text"] {
                    width: calc(100% - 70px);
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    margin: 10px;
                }
        
                button#sendBtn {
                    padding: 10px;
                    border: none;
                    background-color: #0e5be9;
                    color: white;
                    border-radius: 5px;
                    cursor: pointer;
                }
            </style>
        </head>
        <body>
        
            <div class="blue-banner" style="text-align: center;">
                <a href="#" class="icon-container" id="chatbotButton"><i class="fas fa-comment"></i></a>
                Tous droits réservés à ETIC ACADEMY - Site web réalisé par IGLOOHUB
                <div class="social-icons" style="justify-content: flex-start; align-items: center;">
                    <span style="margin-right: 10px;">Suivez-nous :</span>
                    <!-- Icônes de réseaux sociaux -->
                    <a href="#" class="icon-container"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="icon-container"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="icon-container"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        
            <!-- Popup du chatbot -->
            <div id="chatPopup" class="chat-popup">
                <div class="chat-header">
                    <h4>Chatbot Etic Academy</h4>
                    <button id="closeChat" class="close-btn">&times;</button>
                </div>
                <div id="chatBody" class="chat-body">
                    <!-- Messages du chatbot apparaîtront ici -->
                </div>
                <input type="text" id="userInput" placeholder="Posez votre question...">
                <button id="sendBtn">Envoyer</button>
            </div>
        
            <script>
                // Afficher le popup de chat
                document.getElementById("chatbotButton").onclick = function() {
                    document.getElementById("chatPopup").style.display = "block";
                };
        
                // Fermer le popup de chat
                document.getElementById("closeChat").onclick = function() {
                    document.getElementById("chatPopup").style.display = "none";
                };
        
                // Chatbot - Questions et Réponses
                const chatbotResponses = {
"formation": "Nous offrons des formations en développement web, design graphique, et marketing digital.",
"tarif": "Les tarifs varient selon les formations. Pour plus d'informations, contactez-nous directement.",
"durée": "La durée des formations dépend du programme choisi, généralement entre 3 à 6 mois.",
"professeur": "Nos professeurs sont des experts dans leur domaine avec plusieurs années d'expérience.",
"horaire": "Les cours se déroulent du lundi au vendredi, avec des options de cours en journée et en soirée.",
"inscription": "Vous pouvez vous inscrire directement sur notre site web. Les inscriptions sont ouvertes toute l'année.",
"diplôme": "À la fin de la formation, vous recevrez un diplôme reconnu par nos partenaires industriels.",
"stage": "Nous offrons des stages en entreprise à la fin de la formation pour mettre en pratique vos compétences.",
"projets": "Les étudiants travaillent sur des projets concrets tout au long de la formation, y compris des projets collaboratifs.",
"modalités de paiement": "Nous offrons plusieurs options de paiement, y compris des paiements échelonnés.",
"remboursement": "Les remboursements sont possibles sous certaines conditions, veuillez consulter notre politique de remboursement pour plus de détails.",
"partenaires": "Nous collaborons avec plusieurs entreprises pour offrir des opportunités de stage et d'emploi à nos étudiants.",
"admission": "L'admission se fait sur la base d'un dossier de candidature et, dans certains cas, d'un entretien.",
"aide financière": "Nous offrons des bourses et des aides financières pour les étudiants admissibles.",
"matériel requis": "Un ordinateur portable est requis pour suivre les formations. Les logiciels nécessaires seront fournis.",
"langue": "Les formations sont dispensées en français, avec des supports de cours disponibles en anglais pour certains programmes.",
"accompagnement": "Nos mentors vous accompagnent tout au long de votre parcours, avec des sessions de coaching individuel."
};

        
                document.getElementById("sendBtn").onclick = function() {
                    const userInput = document.getElementById("userInput").value.toLowerCase();
                    let response = "Désolé, je n'ai pas compris votre question. Pouvez-vous reformuler ?";
        
                    for (let question in chatbotResponses) {
                        if (userInput.includes(question)) {
                            response = chatbotResponses[question];
                            break;
                        }
                    }
        
                    // Ajouter la question de l'utilisateur
                    addMessage("Vous: " + document.getElementById("userInput").value);
                    
                    // Ajouter la réponse du chatbot
                    addMessage("Chatbot: " + response);
                    
                    // Effacer le champ d'entrée
                    document.getElementById("userInput").value = "";
                };
        
                // Fonction pour ajouter un message dans le chat
                function addMessage(message) {
                    const chatBody = document.getElementById("chatBody");
                    const newMessage = document.createElement("div");
                    newMessage.textContent = message;
                    chatBody.appendChild(newMessage);
                    chatBody.scrollTop = chatBody.scrollHeight;
                }
            </script>
        </footer>
    </div>


    
        </footer>
    </div>








 
 <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>

<script>
$('.carousel .carousel-item').each(function () {
var minPerSlide = 4;
var next = $(this).next();
if (!next.length) {
next = $(this).siblings(':first');
}
next.children(':first-child').clone().appendTo($(this));

for (var i = 0; i < minPerSlide; i++) { next=next.next(); if (!next.length) { next=$(this).siblings(':first'); } next.children(':first-child').clone().appendTo($(this)); } });</script>

    <!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>

</body>
</html>