<?php
session_start();
require 'src/db.php';
// Récupération des vidéos locales
$stmt = $pdo->query('SELECT Titre, URL FROM Video');
$videos = $stmt->fetchAll();

foreach ($videos as $video) {
    $titre = htmlspecialchars($video['Titre']);
    $url = htmlspecialchars($video['URL']);
    $cheminComplet = "videos/" . $url; // Chemin relatif au dossier des vidéos

    if (file_exists($cheminComplet)) {
        echo "<div class='video'>";
        echo "<h2>" . $titre . "</h2>";
        echo "<video width='100%' height='auto' controls>";
        echo "<source src='" . $cheminComplet . "' type='video/mp4'>";
        echo "Votre navigateur ne supporte pas les vidéos.";
        echo "</video>";
        echo "</div>";
    } else {
        echo "<div class='video'><p>La vidéo '$titre' est introuvable.</p></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>NexaStream | Accueil</title>
    <link rel="stylesheet" href="css/index.style.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="menu-icon">
                <img src="https://cdn.discordapp.com/attachments/1070695931290329089/1183711533872717895/texte_1.png?ex=65895445&is=6576df45&hm=41ece0eec66ca7320a2478ddb867061614a79a82115cd2df520b6333ddb87e24&" alt="Menu"> 
            </div>
            <div class="logo">
                <a href="index.php"><img src="https://cdn.discordapp.com/attachments/1070695931290329089/1183720594466951249/video_1.png?ex=65895cb6&is=6576e7b6&hm=b1da34fa01f901d7b3fe2ed3d10a33bbe8fda665f712ee10ec6febca048d155b&" alt="NexaStream"></a> 
            </div>
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Rechercher" aria-label="Rechercher">
                <button class="search-button">
                    <img src="icons/search.svg" alt="Rechercher">
                </button>
            </div>
            <div class="icons">
                <div class="upload-icon">
                    <a href="#"><img src="https://cdn.discordapp.com/attachments/1070695931290329089/1183711379769806858/telechargeur_3.png?ex=65895421&is=6576df21&hm=e786ac08b316b069ca25430c8435a4f0f2c370eabe9bcb3ff8d172a5eb16d74a&" alt="Upload"></a>
                </div>
                <div class="profile-icon">
                    <?php if (isset($_SESSION['username'])): ?>
                        <a href="profil.php"><img src="https://cdn.discordapp.com/attachments/1070695931290329089/1183712138116734977/utilisateur-de-profil_1.png?ex=658954d6&is=6576dfd6&hm=51e1ca214ffd1d8f2f6bb8623da82df2fcb336d7709c1f05cd0ed6791b67c2ed&" alt="Profil"></a>
                    <?php else: ?>
                        <a href="login.php"><img src="https://cdn.discordapp.com/attachments/1070695931290329089/1183712138116734977/utilisateur-de-profil_1.png?ex=658954d6&is=6576dfd6&hm=51e1ca214ffd1d8f2f6bb8623da82df2fcb336d7709c1f05cd0ed6791b67c2ed&" alt="Login"></a>
                        <a href="register.html"><img src="" alt="Register"></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="video-container">
        <?php
        ?>
    </div>
</body>
</html>