<?php
// Dans un fichier appelé getUsers.php
require 'db.php';

$stmt = $pdo->query('SELECT * FROM Utilisateur');
$users = $stmt->fetchAll();

echo json_encode($users);
?>