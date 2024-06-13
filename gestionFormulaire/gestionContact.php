<?php
function traiterFormulaireContact() {
    $erreurs = [];

    // Vérification si la méthode d'envoi est bien "POST"
    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
        
        // Récupération des champs du formulaire
        $nom = isset($_POST["nom"]) ? htmlspecialchars($_POST["nom"]) : '';
        $prenom = isset($_POST["prenom"]) ? htmlspecialchars($_POST["prenom"]) : '';
        $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : '';
        $message = isset($_POST["message"]) ? htmlspecialchars($_POST["message"]) : '';

        // Traitement du nom
        if (empty($nom)) {
            $erreurs[] = "Le champ nom est vide.";
        } elseif (strlen($nom) < 2 || strlen($nom) > 255) {
            $erreurs[] = "La longueur du nom doit être comprise entre 2 et 255 caractères.";
        }

        // Traitement du prénom
        if (empty($prenom)) {
            $erreurs[] = "Le champ prénom est vide.";
        } elseif (strlen($prenom) < 2 || strlen($prenom) > 255) {
            $erreurs[] = "La longueur du prénom doit être comprise entre 2 et 255 caractères.";
        }

        // Traitement de l'email
        if (empty($email)) {
            $erreurs[] = "Le champ email est vide.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurs[] = "L'adresse email n'est pas valide.";
        }

        // Traitement du message
        if (empty($message)) {
            $erreurs[] = "Le contenu du message est vide.";
        } elseif (strlen($message) < 10 || strlen($message) > 3000) {
            $erreurs[] = "Le message ne peut contenir qu'entre 10 et 3000 caractères.";
        }

    }

    return ["errors" => $erreurs];
}
?>



<!-- // Si aucune erreur, envoyer l'email
    if (empty($erreurs)) {
        $destinataire = "nicolasdeza@hotmail.be";  // Votre adresse email
        $sujet = "Message de contact de $prenom $nom";
        $corps = "Nom: $nom\nPrénom: $prenom\nEmail: $email\nMessage: $message";
        $headers = "From: $email";  // Attention à la configuration de l'en-tête pour éviter d'être marqué comme spam

        if (mail($destinataire, $sujet, $corps, $headers)) {
            echo "<p>Merci de nous avoir contacté, $prenom $nom.</p>";
        } else {
            $erreurs[] = "Erreur lors de l'envoi du message. Veuillez réessayer.";
        }
    } -->