<?php
session_start();

// Initialisation ou incrément du compteur de tentatives
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// Limiter le nombre de tentatives de connexion
if ($_SESSION['login_attempts'] > 5) {
    die("Trop de tentatives de connexion. Réessayez plus tard.");
}

require 'db.php'; // Connexion à la base de données

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

// Requête pour vérifier l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM Utilisateur WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();

// Vérifier si l'utilisateur existe et que le mot de passe correspond
if ($user && password_verify($password, $user['Password'])) {
    $_SESSION['username'] = $user['Username'];
    $_SESSION['login_attempts'] = 0; // Réinitialisation du compteur après connexion réussie
    header("Location: ../index.php");
    exit;
} else {
    $_SESSION['login_attempts']++; // Incrémenter le compteur après un échec
    header("Location: ../login.php?error=1");
    exit;
}
?>
