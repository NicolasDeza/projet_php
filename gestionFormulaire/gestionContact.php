<?php 
// TRAITEMENT CONTACT

// Verification si la methode d'envoi est bien " POST "
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
     
    // Création du tableau d'erreurs
    $erreurs = [];
     
    // Recuperation des champs du formulaire
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    // Traitement du nom
    if (isset($nom) && empty($nom)) {
        $erreurs[] = "Le champ nom est vide.";
    } elseif (strlen($nom) < 2 || strlen($nom) > 255) {
        $erreurs[] = "La longueur du nom doit être comprise entre 2 et 255 caractères.";
    }

    // Traitement du prenom
    if (isset($prenom) && empty($prenom)) {
        $erreurs[] = "Le champ prénom est vide.";
    } elseif (strlen($prenom) < 2 || strlen($prenom) > 255) {
        $erreurs[] = "La longueur du prénom doit être comprise entre 2 et 255 caractères.";
    }

    // Traitement de l'email
    if (isset($email) && empty($email)) {
        $erreurs[] = "Le champ email est vide.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse email n'est pas valide.";
    }

    // Traitement du message
    if (isset($message) && empty($message)) {
        $erreurs[] = "Le contenu du message est vide.";
    } elseif (strlen($message) < 10 || strlen($message) > 3000) {
        $erreurs[] = "Le message ne peut contenir qu'entre 10 et 3000 caractères.";
    }

    // Afficher les messages d'erreurs ou envoyer l'email
    if (!empty($erreurs)) {
        foreach ($erreurs as $erreur) {
            echo "<p>" . $erreur . "</p>";
        }
    } else {
        
// Préparation et envoi de l'email
$destinataire = "nicolasdeza@hotmail.be";  // Votre adresse email
$sujet = "Message de contact de $prenom $nom";
$corps = "Nom: $nom\nPrénom: $prenom\nEmail: $email\nMessage: $message";
$headers = "From: $email";  // Attention à la configuration de l'en-tête pour éviter d'être marqué comme spam

if (mail($destinataire, $sujet, $corps, $headers)) {
    echo "<p>Merci de nous avoir contacté, $prenom $nom.</p>";
} else {
    echo "<p>Erreur lors de l'envoi du message. Veuillez réessayer.</p>";
}
}

}
?>
