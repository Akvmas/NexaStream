<?php
// Démarrer la session
session_start();

// Détruire toutes les données de session
session_destroy();

// Redirection vers la page de connexion ou la page d'accueil
header("Location: login.php");
exit;
?>
