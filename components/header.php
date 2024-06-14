<?php
session_start(); 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$metaDescription?>">
    <link rel="stylesheet" type="text/css" href="/public/style/reset.css">
    <link rel="stylesheet" type="text/css" href="/public/style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title><?=$titrePage?></title>
</head>
<body>
<div id="wrapp">
 <header> 
    <h1><a href="/index.php"><span id="point">Projet PHP</a></h1>
        <nav>
            <ul>
                <li><a href="index.php">Acceuil</a></li>

                <?php if(!isset($_SESSION['user_email'])): ?>
                <li><a href="inscription.php">Inscription</a></li>
                <?php endif; ?>
    
                <?php if (!isset($_SESSION['user_email'])): ?>
                    <li><a href="connexion.php">Connexion</a></li>
                <?php endif; ?>

                <li><a href="contact.php">Contact</a></li>
                 
                      <!-- BOUTON DECONNEXION -->  
                <?php if (isset($_SESSION['user_email'])): ?>
                    <li id="li-deconnexion"><a href="deconnexion.php">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
</body>
</html>