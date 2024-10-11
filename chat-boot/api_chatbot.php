<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tableau des réponses possibles avec les mots-clés
    $responses = [
        "formation" => "Nous proposons des formations en développement web, design graphique, marketing digital, et bien plus.",
        "tarif" => "Les tarifs varient selon la formation. Contactez-nous pour plus de détails.",
        "horaire" => "Les cours sont disponibles en ligne à tout moment, vous pouvez apprendre à votre propre rythme.",
        "contact" => "Vous pouvez nous contacter à travers notre site web ou par téléphone au +123456789.",
        "inscription" => "Pour vous inscrire, veuillez remplir le formulaire en ligne sur notre site web.",
        "durée" => "La durée des formations varie entre 3 à 6 mois selon le programme choisi.",
        "formateur" => "Nos formateurs sont des professionnels expérimentés dans leurs domaines respectifs, avec plusieurs années d'expérience.",
    ];

    // Récupère le message de l'utilisateur
    $userMessage = strtolower(trim($_POST['message']));
    
    $response = "Je ne suis pas sûr de comprendre. Pourriez-vous reformuler votre question ?";

    // Parcourt les mots-clés et vérifie si l'un d'eux est présent dans le message de l'utilisateur
    foreach ($responses as $keyword => $reply) {
        if (strpos($userMessage, $keyword) !== false) {
            $response = $reply;
            break;
        }
    }

    // Renvoie la réponse en JSON
    echo json_encode(["response" => $response]);
    exit();
} else {
    echo json_encode(["error" => "Méthode non supportée"]);
    exit();
}
?>
