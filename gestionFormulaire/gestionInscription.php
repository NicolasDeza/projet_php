<?php 

function validationInscription() {
    $erreurs = [];
    $data = null;

    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
        $pseudo = htmlspecialchars($_POST["inscription_pseudo"]);
        $email = htmlspecialchars($_POST["inscription_email"]);
        $mdp = htmlspecialchars($_POST["inscription_mdp"]);
        $confirmationMdp = htmlspecialchars($_POST["inscription_confirmation_mdp"]);

        // Validation
        if (empty($pseudo)) {
            $erreurs['pseudo'] = "Le champ pseudo est vide.";
        } elseif (strlen($pseudo) < 2 || strlen($pseudo) > 255) {
            $erreurs['pseudo'] = "La longueur du pseudo doit être comprise entre 2 et 255 caractères.";
        }
        if (empty($email)) {
            $erreurs['email'] = "Le champ email est vide.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurs['email'] = "L'adresse email n'est pas valide.";
        }
        if (empty($mdp)) {
            $erreurs['mdp'] = "Le champ mot de passe est vide.";
        } elseif (strlen($mdp) < 6) {
            $erreurs['mdp'] = "Le mot de passe n'est pas assez long.";
        } elseif (strlen($mdp) > 127) {
            $erreurs['mdp'] = "Le mot de passe est trop long.";
        }
        if (empty($confirmationMdp)) {
            $erreurs['confirmationMdp'] = "Le champ confirmation du mot de passe est vide.";
        } elseif ($mdp !== $confirmationMdp) {
            $erreurs['confirmationMdp'] = "Les mots de passe ne correspondent pas.";
        }

        if (empty($erreurs)) {
            $data = ['pseudo' => $pseudo, 'email' => $email, 'mdp' => $mdp];
        }
    }

    return ['errors' => $erreurs, 'data' => $data];
}
