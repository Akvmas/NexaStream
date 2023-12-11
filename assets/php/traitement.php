<?php
// Inclure le fichier de configuration de la base de données
include('config.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Vérifier si les mots de passe correspondent et respectent les règles
    if ($password !== $confirm_password || !preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/', $password)) {
        echo "Les mots de passe ne correspondent pas ou ne respectent pas les règles.";
    } else {
        // Se connecter à la base de données
        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("La connexion à la base de données a échoué : " . $conn->connect_error);
        }

        // Échapper les données pour éviter les attaques SQL (utiliser des déclarations préparées pour une sécurité optimale)
        $username = $conn->real_escape_string($username);
        $password = password_hash($conn->real_escape_string($password), PASSWORD_BCRYPT);

        // Vérifier si l'utilisateur existe déjà dans la base de données
        $check_user_query = "SELECT * FROM Utilisateur WHERE Username = '$username'";
        $result = $conn->query($check_user_query);

        if ($result->num_rows > 0) {
            echo "L'utilisateur existe déjà. Veuillez vous connecter <a href='page_connexion.php'>ici</a>.";
        } else {
            // Insérer l'utilisateur dans la base de données
            $insert_user_query = "INSERT INTO Utilisateur (Username, Password) VALUES ('$username', '$password')";

            if ($conn->query($insert_user_query) === TRUE) {
                echo "Inscription réussie. Vous pouvez maintenant vous connecter <a href='page_connexion.php'>ici</a>.";
            } else {
                echo "Erreur lors de l'inscription : " . $conn->error;
            }
        }

        // Fermer la connexion à la base de données
        $conn->close();
    }
} else {
    // Rediriger si le formulaire n'a pas été soumis
    header("Location: ../../index.php");
    exit();
}
?>
