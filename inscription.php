<?php 
$titrePage = "Inscription";
$metaDescription = "Inscrivez-vous";

define('DS', DIRECTORY_SEPARATOR);

require_once __DIR__ . DS . "components" . DS . "header.php";

?>


<?php

require_once __DIR__ . DS . "gestionFormulaire" . DS . "gestionInscription.php";
$resultat = validationInscription();
$erreurs = $resultat['errors'];

if (empty($erreurs) && isset($resultat['data'])) {
    $data = $resultat['data'];
    $pseudo = $data['pseudo'];
    $email = $data['email'];
    $mdp = $data['mdp'];


    $nomDuServeur = "localhost";
    $nomUtilisateur = "root";
    $nomBaseDeDonnees = "projet_php";

    try {
        $pdo = new PDO("mysql:host=$nomDuServeur;dbname=$nomBaseDeDonnees", $nomUtilisateur);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);

        $requete = $pdo->prepare("INSERT INTO utilisateurs (pseudo, email, mot_de_passe) VALUES (:pseudo, :email, :mdp)");
         
        $requete->bindParam(':pseudo', $pseudo);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':mdp', $mdpHash);

        $requete->execute();

        echo "<p>Inscription réussie !</p>";
    } catch (PDOException $e) {
        echo "<p>Erreur d'exécution de requête : " . $e->getMessage() . "</p>";
    } 
}  else {
    foreach ($erreurs as $erreur) {
        echo "<p style='color: red;'>$erreur</p>";
    }
}
?>


<form method="POST" action="inscription.php">

    <label for="inscription_pseudo">Pseudo:</label>
    <input type="text" id="inscription_pseudo" name="inscription_pseudo">
    <?php echo !empty($errors['pseudo']) ? '<div style="color: red;">' . $errors['pseudo'] . '</div>' : ''; ?>
    <br><br>

    <label for="inscription_email">Email :</label>
    <input type="email" id="inscription_email" name="inscription_email" required>
    <?php echo !empty($errors['email']) ? '<div style="color: red;">' . $errors['email'] . '</div>' : ''; ?>
    <br><br>

    <label for="inscription_mdp">Mot de passe :</label>
    <input type="password" id="inscription_mdp" name="inscription_mdp" minlength="2" maxlength="72" required>
    <?php echo !empty($errors['mdp']) ? '<div style="color: red;">' . $errors['mdp'] . '</div>' : ''; ?>
    <br><br>

    <label for="inscription_confirmation_mdp">Confirmation mot de passe :</label>
    <input type="password" id="inscription_confirmation_mdp" name="inscription_confirmation_mdp" minlength="2" maxlength="72" required>
    <?php echo !empty($errors['confirmationMdp']) ? '<div style="color: red;">' . $errors['confirmationMdp'] . '</div>' : ''; ?>
    <br><br>

    <button class="submit" type="submit">Envoyer</button>

</form>



<?php 
require_once __DIR__ . DS . "components" . DS . "footer.php";
?>