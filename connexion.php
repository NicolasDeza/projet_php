<?php 

$titrePage = "Connexion";
$metaDescription = "Connectez-vous";

define('DS', DIRECTORY_SEPARATOR); 

require_once __DIR__ . DS . "components" . DS . "header.php";
require_once __DIR__ . DS . "gestionFormulaire" . DS . "gestionConnexion.php";

$erreurs = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $erreurs = validationConnexion(); 

    if (empty($erreurs)) {
        $email = htmlspecialchars($_POST['connexion_email']);
        $mdp = htmlspecialchars($_POST['connexion_mdp']);

        $nomDuServeur = "sql308.infinityfree.com";
        $nomUtilisateur = "if0_36730460";
        $motDePasse = "35ShuX2HiwVdMM"; 
        $nomBaseDeDonnees = "if0_36730460_projet_php";

        try {
            $pdo = new PDO("mysql:host=$nomDuServeur;dbname=$nomBaseDeDonnees", $nomUtilisateur, $motDePasse);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $requete = $pdo->prepare("SELECT pseudo, mot_de_passe FROM utilisateurs WHERE email = :email");
            $requete->bindParam(':email', $email);  
            $requete->execute();

            $user = $requete->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($mdp, $user['mot_de_passe'])) { 
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $user['pseudo'];

                setcookie("user_email", $email, time() + 3600);
                setcookie("user_name", $user['pseudo'], time() + 3600);

               
                header("Location: bienvenue.php");
                exit;
            } else {
                $erreurs[] = "Email ou mot de passe incorrect.";
            }

        } catch(PDOException $e) {
            $erreurs[] = "Erreur d'exécution de requête : " . $e->getMessage();
        }
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

   <form    method="POST" action="" >
    <label for="connexion_email">Email :</label>
    <input type="email" id="connexion_email" name="connexion_email" required>
    <br><br>

    <label for="connexion_mdp">Mot de passe :</label>
    <input type="password" id="connexion_mdp" name="connexion_mdp" required>
    <br><br>

    <button class="submit" type="submit">Envoyer</button>
</form>
</div>

<?php 
require_once __DIR__ . DS . "components" . DS . "footer.php";
ob_end_flush(); // Envoyer le contenu tamponné au navigateur
?>
