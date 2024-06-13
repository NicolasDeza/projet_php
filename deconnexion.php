<?php

session_start();


session_unset();  // Libérer toutes les variables de session


session_destroy();  // Détruire la session


setcookie('user_email', '', time() - 3600, '/'); 
setcookie('user_name', '', time() - 3600, '/'); 


header('Location: index.php');
exit;
?>