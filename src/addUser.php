<?php
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['username']) && isset($data['password']) && isset($data['role'])) {
    $username = filter_var($data['username'], FILTER_SANITIZE_STRING);
    $password = password_hash($data['password'], PASSWORD_DEFAULT); // Hashage du mot de passe
    $role = filter_var($data['role'], FILTER_SANITIZE_STRING);

    try {
        $stmt = $pdo->prepare('INSERT INTO Utilisateur (Username, Password, Role) VALUES (?, ?, ?)');
        $stmt->execute([$username, $password, $role]);
        http_response_code(201); // Réponse HTTP pour la création réussie
        echo json_encode(['message' => 'Utilisateur créé']);
    } catch (PDOException $e) {
        http_response_code(500); // Réponse HTTP pour l'erreur serveur
        echo json_encode(['message' => 'Erreur lors de la création de l’utilisateur']);
    }
} else {
    http_response_code(400); // Réponse HTTP pour une requête incorrecte
    echo json_encode(['message' => 'Informations manquantes']);
}
?>
