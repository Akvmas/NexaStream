<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require 'src/db.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>NexaStream | Accueil</title>
    <link rel="stylesheet" href="css/index.style.css">
    <script src="src/script.js"></script>
</head>
<body>
<nav class="navbar">
    <div class="navbar-container">
        <div class="logo">
            <a href="index.php"><img src="https://cdn.discordapp.com/attachments/1070695931290329089/1183720594466951249/video_1.png?ex=65895cb6&is=6576e7b6&hm=b1da34fa01f901d7b3fe2ed3d10a33bbe8fda665f712ee10ec6febca048d155b&" alt="NexaStream"></a> 
        </div>
        <div class="search-container">
        <form id="search-form" action="index.php" method="get">
            <select class="search-input-filter" name="categorie">
                <option value="Tous">Tous</option>
                <option value="cybersecurity">Cybersécurité</option>
                <option value="web development">Développement Web</option>
                <option value="android development">Développement Android</option>
            </select>
            <input type="text" class="search-input" name="search" placeholder="Rechercher" aria-label="Rechercher">
            <button class="search-button" type="submit">
                <img src="https://cdn.discordapp.com/attachments/1070695931290329089/1186256751557890088/loupe.png?ex=659296b1&is=658021b1&hm=abe752668ef39ab813090c6712725b5aa4dea50ce81ca3e545ae6b43e2c1d7d3&" alt="Rechercher">
            </button>
        </form>
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
    </nav>
    <div class="video-container">
    <?php
    include 'get_videos.php';
    ?>
</div>
</body>
</html>
