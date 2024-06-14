<?php

session_start();


session_unset();  


session_destroy();  


setcookie('user_email', '', time() - 3600, '/'); 
setcookie('user_name', '', time() - 3600, '/'); 


header('Location: index.php');
exit;
?>