<?php
function validationConnexion() {
    $erreurs = [];

    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
        
     
        $email = isset($_POST["connexion_email"]) ? htmlspecialchars($_POST["connexion_email"]) : '';
        $mdp = isset($_POST["connexion_mdp"]) ? htmlspecialchars($_POST["connexion_mdp"]) : '';

        // Traitement de l'email
        if (empty($email)) {
            $erreurs[] = "Le champ email est vide.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurs[] = "L'adresse email n'est pas valide.";
        }

        // Traitement du mot de passe
        if (empty($mdp)) {
            $erreurs[] = "Le champ mot de passe est vide.";
        }
    }

    return $erreurs;
}
?>