<?php
require 'db.php'; // Connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Vérifiez si le mot de passe correspond à la confirmation
    if ($password !== $confirm_password) {
        die("Les mots de passe ne correspondent pas.");
    }

    // Vérifiez la force du mot de passe (exemple basique)
    if (strlen($password) < 8) {
        die("Le mot de passe doit contenir au moins 8 caractères.");
    }

    // Hashage du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Vérifier l'unicité du nom d'utilisateur
        $checkUser = $pdo->prepare("SELECT * FROM Utilisateur WHERE Username = ?");
        $checkUser->execute([$username]);
        if ($checkUser->rowCount() > 0) {
            die("Ce nom d'utilisateur est déjà pris.");
        }

        // Insertion dans la base de données
        $stmt = $pdo->prepare("INSERT INTO Utilisateur (Username, Password) VALUES (?, ?)");
        $stmt->execute([$username, $hashedPassword]);
        echo "Inscription réussie. <a href='../login.php'>Se connecter</a>";
    } catch (\PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
