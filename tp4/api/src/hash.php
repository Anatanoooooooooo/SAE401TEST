<?php
require "../config/connexion_db.php";

// ID de l'utilisateur dont tu veux hasher le mot de passe
$id = 4; // Remplace 1 par l'ID souhaité

// Récupérer l'utilisateur spécifique
$query = $conn->prepare("SELECT mdp FROM personne WHERE id = ?");
$query->execute([$id]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $plainPassword = $user['mdp'];

    // Hasher le mot de passe
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

    // Mettre à jour l'utilisateur avec le mot de passe haché
    $updateQuery = $conn->prepare("UPDATE personne SET mdp = ? WHERE id = ?");
    $updateQuery->execute([$hashedPassword, $id]);

    echo "Mot de passe mis à jour avec succès pour l'utilisateur ID $id.";
} else {
    echo "Utilisateur non trouvé.";
}
?>