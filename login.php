<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion NexaStream</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="login-container">
        <h2>Connexion</h2>
        <form action="src/auth.php" method="POST">
            <?php if (isset($_GET['error'])): ?>
            <p style="color: red;">Nom d'utilisateur ou mot de passe incorrect</p>
            <?php endif; ?>
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="submit" value="Se connecter">
        </form>
    </div>
</body>

</html>