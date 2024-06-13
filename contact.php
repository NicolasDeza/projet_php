<?php 
$titrePage = "Contact";
$metaDescription ="Formulaire de contact";

define('DS', DIRECTORY_SEPARATOR);
?>


<?php 
require_once __DIR__ . DS . "components" . DS . "header.php";
?>



<form id="contact" method="post" action="/contact.php" >
    <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" minlength="2" maxlength="255"  required>
    <br><br>
    <label for="prenom">Prénom :<label>
        <input type="text" id="prenom" name="prenom" minlength="2" maxlength="255" required>
    <br><br>
    <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
    <br><br>
    <label for="message">Message</label>
        <input type="text" id="message" name="message" minlength="10" maxlength="3000" required>
    <br><br>
    <button class="submit" type="submit">Envoyer</button>
</form>






<?php 
require_once __DIR__ . DS . "components" . DS . "footer.php";
?>