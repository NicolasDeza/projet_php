<?php 
$titrePage = "Inscription";
$metaDescription = "Inscrivez-vous";

define('DS', DIRECTORY_SEPARATOR);

require_once __DIR__ . DS . "components" . DS . "header.php";
require_once __DIR__ . DS . "gestionFormulaire" . DS . "gestionInscription.php";

$erreurs = validationInscription();

if ($_SERVER["REQUEST_METHOD"] === "POST" && empty($erreurs)) {
    $pseudo = htmlspecialchars($_POST["inscription_pseudo"]);
    $email = htmlspecialchars($_POST["inscription_email"]);
    $mdp = password_hash(htmlspecialchars($_POST["inscription_mdp"]), PASSWORD_DEFAULT);


    $nomDuServeur = "sql308.infinityfree.com";
    $nomUtilisateur = "if0_36730460";
    $motDePasse = "35ShuX2HiwVdMM"; 
    $nomBaseDeDonnees = "if0_36730460_projet_php";

    try {
        $pdo = new PDO("mysql:host=$nomDuServeur;dbname=$nomBaseDeDonnees", $nomUtilisateur, $motDePasse);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $requete = $pdo->prepare("INSERT INTO utilisateurs (pseudo, email, mot_de_passe) VALUES (:pseudo, :email, :mdp)");
        $requete->bindParam(':pseudo', $pseudo);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':mdp', $mdp);

        $requete->execute();

        header("Location: connexion.php"); 
        exit;
    } catch(PDOException $e) {
        echo "<p style='color: red;'>Erreur d'exécution de requête : " . $e->getMessage() . "</p>";
    } 
}
?>

<div class="form-container">
    <div class="messages">
        <?php
        if (!empty($erreurs)) {
            foreach ($erreurs as $erreur) {
                echo "<p style='color: red;'>" . htmlspecialchars($erreur) . "</p>";
            }
        }
        ?>
    </div>
  <form   method="POST" action="inscription.php">

    <label for="inscription_pseudo">Pseudo:</label>
    <input type="text" id="inscription_pseudo" name="inscription_pseudo">
  
    <br><br>

    <label for="inscription_email">Email :</label>
    <input type="email" id="inscription_email" name="inscription_email" required>

    <br><br>

    <label for="inscription_mdp">Mot de passe :</label>
    <input type="password" id="inscription_mdp" name="inscription_mdp" minlength="2" maxlength="72" required>

    <br><br>

    <label for="inscription_confirmation_mdp">Confirmation mot de passe :</label>
    <input type="password" id="inscription_confirmation_mdp" name="inscription_confirmation_mdp" minlength="2" maxlength="72" required>

    <br><br>

    <button class="submit" type="submit">Envoyer</button>

</form>
</div>
<?php 
require_once __DIR__ . DS . "components" . DS . "footer.php";
?>
