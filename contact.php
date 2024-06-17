<?php 
$titrePage = "Contact";
$metaDescription = "Formulaire de contact";

define('DS', DIRECTORY_SEPARATOR);

require_once __DIR__ . DS . "components" . DS . "header.php";
require_once __DIR__ . DS . "gestionFormulaire" . DS . "gestionContact.php";

$resultat = validationContact(); 

$erreurs = isset($resultat["errors"]) ? $resultat["errors"] : [];
$succes = isset($resultat['succes']) ? $resultat["succes"] : "";
?>

<div class="form-container">
    <div class="error-messages">
        <?php
        if (!empty($erreurs)) {
            foreach ($erreurs as $erreur) {
                echo "<p>" . htmlspecialchars($erreur) . "</p>";
            }
        }
        if(!empty($succes)) {
            echo "<p style='color: green';>" . htmlspecialchars($succes) . '</p>';
        }
        ?>
    </div>

    <form method="post" action="contact.php">
        
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>
        <br><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="message">Message :</label>
        <textarea id="message" name="message" required></textarea>
        <br><br>

        <button class="submit" type="submit">Envoyer</button>
    </form>
</div>

<?php 
require_once __DIR__ . DS . "components" . DS . "footer.php";
?>
