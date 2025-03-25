<?php
//Va savoir pourquoi, mais ça fonctionne comme ça 
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    http_response_code(200); // Réponse OK
    exit();
}
// Inclure le fichier de connexion
require "../config/connexion_db.php"; // Charge la variable $conn

try {
    // Récupération des données DELETE
    $data = json_decode(file_get_contents("php://input"), true);

    // Vérifiez si l'ID est fourni
    if (!isset($data['id_personne'])) {
        http_response_code(400);
        echo json_encode(["message" => "ID de la personne non fourni"]);
        exit();
    }

    $id_personne = $data['id_personne'];

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