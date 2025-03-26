<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    http_response_code(200); // Répondez avec un statut OK pour OPTIONS
    exit();
}

require "../config/connexion_db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['titre'], $data['texte'])) {
        $titre = $data['titre'];
        $texte = $data['texte'];

        $query = $conn->prepare("INSERT INTO avis (titre, texte) VALUES (?, ?)");
        if ($query->execute([$titre, $texte])) {
            echo json_encode(["message" => "Avis ajouté avec succès"]);
        } else {
            echo json_encode(["message" => "Erreur lors de l'ajout de l'avis"]);
        }
    } else {
        echo json_encode(["message" => "Données manquantes ou invalides"]);
    }
}
?>