<?php 

function validationConnexion() {
    
    $erreurs = [];

    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
      
        $email = htmlspecialchars($_POST["connexion_email"]);
        $mdp = htmlspecialchars($_POST["connexion_mdp"]);  
        // Validation de l'email
        if (empty($email)) {
            $erreurs['email'] = "Le champ email est vide.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurs['email'] = "L'adresse email n'est pas valide.";
        }

        // Validation du mot de passe
        if (empty($mdp)) {
            $erreurs['mdp'] = "Le champ mot de passe est vide.";
        }

        // Affichage des erreurs
        if (!empty($erreurs)) {
            return $erreurs;  // Retourne le tableau d'erreurs pour un traitement ultérieur
        } else {
            return ['email' => $email, 'mdp' => $mdp];  // Retourne les données validées pour une vérification de connexion
        }
    }

    return $erreurs;  // Si le formulaire n'est pas soumis, retourne les erreurs vides
}
