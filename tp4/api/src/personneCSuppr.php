<?php
header("Access-Control-Allow-Origin: *"); // POUR TOUS
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS"); // Méthodes autorisées
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Inclure le fichier de connexion
require "../config/connexion_db.php";

try {
    // Récupération de l'ID dans les paramètres de la requête
    if (!isset($_GET['id_personne'])) {
        http_response_code(400);
        echo json_encode(["message" => "ID de la personne non fourni"]);
        exit();
    }

    $id_personne = intval($_GET['id_personne']);

    // Étape 1 : Supprimer les informations de la table `candidat`
    $sqlCandidat = "DELETE FROM candidat WHERE id_personne = :id_personne";
    $stmt = $conn->prepare($sqlCandidat);
    $stmt->execute([':id_personne' => $id_personne]);

    // Étape 2 : Supprimer les informations de la table `personne`
    $sqlPersonne = "DELETE FROM personne WHERE id = :id_personne";
    $stmt = $conn->prepare($sqlPersonne);
    $stmt->execute([':id_personne' => $id_personne]);

    http_response_code(200);
    echo json_encode(["message" => "Personne et ses informations associées ont été supprimées avec succès"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["message" => "Erreur : " . $e->getMessage()]);
}
?>