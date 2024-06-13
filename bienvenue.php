<?php 

$titrePage = "Bienvenue";
$metaDescription ="Bienvenue sur votre espace personnel";

define('DS', DIRECTORY_SEPARATOR);

require_once __DIR__ . DS . "components" . DS . "header.php";


// Vérifiez si l'utilisateur est connecté et récupérez son nom de la session
if (!isset($_SESSION['user_name'])) {
  
    header('Location: connexion.php');
    exit;
}

$nomUtilisateur = $_SESSION['user_name']; 
$email = $_SESSION['user_email'];
?>



<h1>Bienvenue <?=  htmlspecialchars($nomUtilisateur); ?>, tu es bien connecté !</h1>

<h2>Votre email : <?= htmlspecialchars($email) ?></h2>

<br>

<form action="deconnexion.php" method="post">
    <button type="submit">Déconnexion</button>
</form>



<?php 
require_once __DIR__ . DS . "components" . DS . "footer.php";
?>
