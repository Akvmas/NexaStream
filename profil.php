<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';

$userId = $_SESSION['user_id'];

$stmtUser = $pdo->prepare("SELECT * FROM Utilisateur WHERE Id_Utilisateur = ?");
$stmtUser->execute([$userId]);
$user = $stmtUser->fetch();

if (!$user) {
    header("Location: login.php");
    exit;
}

// Récupérez les vidéos de l'utilisateur
$stmtVideos = $pdo->prepare("SELECT * FROM Video WHERE Id_Chaine IN (SELECT Id_Chaine FROM Chaine WHERE Id_Utilisateur = ?)");
$stmtVideos->execute([$userId]);
$videos = $stmtVideos->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil de <?php echo htmlspecialchars($user['Username']); ?> | NexaStream</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <header class="top-nav">
    </header>
    <main class="profile-container">
        <section class="profile-header">
            <h1>Profil de <?php echo htmlspecialchars($user['Username']); ?></h1>
        </section>

        <section class="user-videos">
            <h2>Vos vidéos</h2>
            <div class="videos-grid">
                <?php foreach ($videos as $video): ?>
                    <article class="video">
                        <h3><?php echo htmlspecialchars($video['Titre']); ?></h3>
                        <video width="320" height="240" controls>
                            <source src="videos/<?php echo htmlspecialchars($video['URL']); ?>" type="video/mp4">
                            Votre navigateur ne prend pas en charge la vidéo.
                        </video>
                        <p><?php echo htmlspecialchars($video['Description']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>
</html>
